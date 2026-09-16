<?php
/**
 * Admin dashboard — login, guest list, filter/sort, delete, CSV export, print view.
 */
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure'   => !empty($_SERVER['HTTPS']),
]);
session_start();
require __DIR__ . '/../php/config.php';

$error = '';

// ---- Login ----
if (isset($_POST['username'], $_POST['password'])) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare('SELECT id, password FROM admin_users WHERE username = :u LIMIT 1');
    $stmt->execute([':u' => trim($_POST['username'])]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($_POST['password'], $admin['password'])) {
        session_regenerate_id(true);
        $_SESSION['mf_admin_ok'] = true;
        $_SESSION['mf_admin_id'] = $admin['id'];
        $_SESSION['mf_csrf'] = bin2hex(random_bytes(16));
    } else {
        $error = 'Incorrect username or password.';
    }
}

// ---- Logout ----
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$loggedIn = !empty($_SESSION['mf_admin_ok']);

if (!$loggedIn) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Admin Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        body{ font-family:Georgia,serif; background:#f7f4ee; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; padding:2em; }
        form{ background:#fff; padding:2.5em; border-radius:14px; box-shadow:0 10px 40px rgba(0,0,0,.08); width:100%; max-width:280px; box-sizing:border-box; }
        h1{ font-size:20px; margin:0 0 1em; color:#5a3b25; }
        input{ width:100%; padding:.7em; margin-bottom:1em; border:1px solid #ccc; border-radius:8px; box-sizing:border-box; }
        button{ width:100%; padding:.7em; background:#b68a45; color:#fff; border:none; border-radius:8px; cursor:pointer; font-size:15px; }
        .err{ color:#a94442; font-size:13px; margin-bottom:1em; }
      </style>
    </head>
    <body>
      <form method="post">
        <h1>Guest List Login</h1>
        <?php if ($error): ?><p class="err"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <input type="text" name="username" placeholder="Username" autofocus required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Enter</button>
      </form>
    </body>
    </html>
    <?php
    exit;
}

// ---- Logged in from here on ----
$pdo = get_db_connection();

// Overall attendee cap — kept in sync with php/rsvp.php's MAX_TOTAL_GUESTS.
const MAX_TOTAL_GUESTS = 200;

$allowedSort = [
    'name' => 'full_name ASC',
    'date' => 'created_at DESC',
    'attending' => "FIELD(attending,'yes','maybe','no'), full_name ASC",
];
$sortKey = $_GET['sort'] ?? 'date';
if (!isset($allowedSort[$sortKey])) {
    $sortKey = 'date';
}
$orderBy = $allowedSort[$sortKey];

$allowedFilter = ['yes', 'no', 'maybe'];
$filter = $_GET['filter'] ?? '';
if (!in_array($filter, $allowedFilter, true)) {
    $filter = '';
}

$where = '';
$params = [];
if ($filter !== '') {
    $where = 'WHERE attending = :att';
    $params[':att'] = $filter;
}

// ---- CSV export (respects current filter + sort) ----
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $stmt = $pdo->prepare("SELECT full_name, phone, attending, guests, party_names, message, created_at FROM rsvp $where ORDER BY $orderBy");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="guest_list.csv"');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM so Excel renders Arabic/accented names correctly
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Full Name', 'Phone', 'Attending', 'Guests', 'Coming With', 'Message', 'Submitted At']);
    foreach ($rows as $r) {
        $companions = $r['party_names'] ?? '';
        fputcsv($out, [$r['full_name'], $r['phone'], $r['attending'], $r['guests'], $companions, $r['message'], $r['created_at']]);
    }
    fclose($out);
    exit;
}

// ---- Delete ----
$deleteError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    if (!hash_equals($_SESSION['mf_csrf'] ?? '', $_POST['csrf'] ?? '')) {
        $deleteError = 'Security check failed — please try again.';
    } else {
        $stmt = $pdo->prepare('DELETE FROM rsvp WHERE id = :id');
        $stmt->execute([':id' => (int)$_POST['delete_id']]);
        header('Location: index.php?' . http_build_query(['sort' => $sortKey, 'filter' => $filter]));
        exit;
    }
}

// ---- Stats ----
$totalAll = (int)$pdo->query('SELECT COUNT(*) FROM rsvp')->fetchColumn();
$counts = ['yes' => 0, 'no' => 0, 'maybe' => 0];
foreach ($pdo->query('SELECT attending, COUNT(*) c FROM rsvp GROUP BY attending') as $row) {
    if (isset($counts[$row['attending']])) $counts[$row['attending']] = (int)$row['c'];
}
$totalGuests = (int)$pdo->query("SELECT COALESCE(SUM(guests),0) FROM rsvp WHERE attending = 'yes'")->fetchColumn();

// Count every single named companion across all confirmed ("yes") RSVPs,
// so it's clear the headcount really is backed by real names.
$namedCompanions = 0;
foreach ($pdo->query("SELECT party_names FROM rsvp WHERE attending = 'yes' AND party_names IS NOT NULL AND party_names != ''") as $row) {
    $names = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $row['party_names'])), function ($n) { return $n !== ''; });
    $namedCompanions += count($names);
}

// ---- Guest list ----
$stmt = $pdo->prepare("SELECT * FROM rsvp $where ORDER BY $orderBy");
$stmt->execute($params);
$rsvps = $stmt->fetchAll();

$csrf = $_SESSION['mf_csrf'] ?? ($_SESSION['mf_csrf'] = bin2hex(random_bytes(16)));

function qs($overrides = []) {
    $current = ['sort' => $_GET['sort'] ?? 'date', 'filter' => $_GET['filter'] ?? ''];
    return '?' . http_build_query(array_merge($current, $overrides));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Guest List — Mabelle &amp; Salim</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body{ font-family:'Segoe UI',Arial,sans-serif; background:#f7f4ee; color:#3f2a1f; margin:0; padding:2em; }
  h1{ color:#5a3b25; font-size:26px; margin-bottom:.2em; }
  .stats{ display:flex; gap:1.2em; margin:1.2em 0 .6em; flex-wrap:wrap; }
  .stat{ background:#fff; border-radius:10px; padding:1em 1.6em; box-shadow:0 4px 20px rgba(0,0,0,.05); }
  .stat b{ display:block; font-size:22px; color:#b68a45; }
  .cap-note{ font-size:12.5px; color:#6b5a4d; margin:0 0 1.6em; }
  .cap-note b{ color:#5a3b25; }
  .toolbar{ display:flex; gap:1em; align-items:center; flex-wrap:wrap; margin-bottom:1.2em; }
  .toolbar a, .toolbar select{ font-size:13px; }
  select{ padding:.5em; border-radius:8px; border:1px solid #ccc; }
  table{ width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.05); }
  th, td{ padding:.8em 1em; text-align:left; border-bottom:1px solid #eee; font-size:14px; vertical-align:top; }
  th{ background:#f2ede2; color:#5a3b25; text-transform:uppercase; font-size:11px; letter-spacing:.06em; }
  th a{ color:inherit; text-decoration:none; }
  tr:last-child td{ border-bottom:none; }
  .yes{ color:#3f7a4f; font-weight:600; }
  .no{ color:#a94442; font-weight:600; }
  .maybe{ color:#a4842a; font-weight:600; }
  .party-names{ margin:0; padding-left:1.1em; font-size:13px; }
  .party-names li{ margin:.1em 0; }
  .party-empty{ opacity:.4; }
  .top-actions{ margin-bottom:1.5em; display:flex; gap:1em; align-items:center; flex-wrap:wrap; }
  a.btn, button.btn{ background:#b68a45; color:#fff; padding:.6em 1.2em; border-radius:8px; text-decoration:none; font-size:13px; border:none; cursor:pointer; font-family:inherit; }
  a.logout{ color:#a94442; font-size:13px; text-decoration:none; }
  .del-btn{ background:none; border:none; color:#a94442; cursor:pointer; font-size:12px; text-decoration:underline; padding:0; }
  .filter-chip{ padding:.4em 1em; border-radius:20px; border:1px solid #ccc; text-decoration:none; color:#5a3b25; font-size:12.5px; }
  .filter-chip.active{ background:#b68a45; color:#fff; border-color:#b68a45; }
  @media print{
    .toolbar, .top-actions, .del-btn, th:last-child, td:last-child{ display:none !important; }
    body{ padding:0; background:#fff; }
    table{ box-shadow:none; }
  }
</style>
</head>
<body>
  <h1>Mabelle &amp; Salim — Guest List</h1>

  <div class="top-actions">
    <a class="btn" href="<?= htmlspecialchars(qs(['export' => 'csv'])) ?>">Download CSV</a>
    <button class="btn" onclick="window.print()">Print View</button>
    <a class="logout" href="index.php?logout=1">Log out</a>
  </div>

  <?php if ($deleteError): ?><p style="color:#a94442;"><?= htmlspecialchars($deleteError) ?></p><?php endif; ?>

  <div class="stats">
    <div class="stat"><b><?= $totalAll ?></b>Responses</div>
    <div class="stat"><b><?= $counts['yes'] ?></b>Attending</div>
    <div class="stat"><b><?= $counts['no'] ?></b>Not attending</div>
    <div class="stat"><b><?= $counts['maybe'] ?></b>Maybe</div>
    <div class="stat"><b><?= $totalGuests ?></b>Total confirmed guests</div>
    <div class="stat"><b><?= $namedCompanions ?></b>Named companions</div>
  </div>
  <p class="cap-note">Confirmed headcount: <b><?= $totalGuests ?> / <?= MAX_TOTAL_GUESTS ?></b> guests. New "Count me in!" RSVPs stop being accepted once this reaches <?= MAX_TOTAL_GUESTS ?>.</p>

  <div class="toolbar">
    <a class="filter-chip <?= $filter === '' ? 'active' : '' ?>" href="<?= htmlspecialchars(qs(['filter' => ''])) ?>">All</a>
    <a class="filter-chip <?= $filter === 'yes' ? 'active' : '' ?>" href="<?= htmlspecialchars(qs(['filter' => 'yes'])) ?>">Attending</a>
    <a class="filter-chip <?= $filter === 'maybe' ? 'active' : '' ?>" href="<?= htmlspecialchars(qs(['filter' => 'maybe'])) ?>">Maybe</a>
    <a class="filter-chip <?= $filter === 'no' ? 'active' : '' ?>" href="<?= htmlspecialchars(qs(['filter' => 'no'])) ?>">Not attending</a>

    <select onchange="location.href=this.value">
      <option value="<?= htmlspecialchars(qs(['sort' => 'date'])) ?>" <?= $sortKey === 'date' ? 'selected' : '' ?>>Sort: Newest first</option>
      <option value="<?= htmlspecialchars(qs(['sort' => 'name'])) ?>" <?= $sortKey === 'name' ? 'selected' : '' ?>>Sort: Name (A–Z)</option>
      <option value="<?= htmlspecialchars(qs(['sort' => 'attending'])) ?>" <?= $sortKey === 'attending' ? 'selected' : '' ?>>Sort: Attendance</option>
    </select>
  </div>

  <table>
    <thead>
      <tr><th>Name</th><th>Phone</th><th>Attending</th><th>Guests</th><th>Coming With</th><th>Message</th><th>Submitted</th><th></th></tr>
    </thead>
    <tbody>
      <?php if (!$rsvps): ?>
        <tr><td colspan="8">No responses yet.</td></tr>
      <?php endif; ?>
      <?php foreach ($rsvps as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['full_name']) ?></td>
          <td><?= htmlspecialchars($r['phone'] ?? '—') ?></td>
          <td class="<?= htmlspecialchars($r['attending']) ?>"><?= ucfirst($r['attending']) ?></td>
          <td><?= (int)$r['guests'] ?></td>
          <td>
            <?php
              $names = [];
              if (!empty($r['party_names'])) {
                  $names = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $r['party_names'])), function ($n) { return $n !== ''; });
              }
            ?>
            <?php if ($names): ?>
              <ol class="party-names">
                <?php foreach ($names as $n): ?>
                  <li><?= htmlspecialchars($n) ?></li>
                <?php endforeach; ?>
              </ol>
            <?php else: ?>
              <span class="party-empty">—</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($r['message'] ?? '') ?></td>
          <td><?= htmlspecialchars($r['created_at']) ?></td>
          <td>
            <form method="post" onsubmit="return confirm('Delete this RSVP from ' + <?= json_encode($r['full_name']) ?> + '?');">
              <input type="hidden" name="delete_id" value="<?= (int)$r['id'] ?>">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf) ?>">
              <button type="submit" class="del-btn">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
