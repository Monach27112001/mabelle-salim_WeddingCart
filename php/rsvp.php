<?php
/**
 * Receives an RSVP submission (JSON POST from the website's form) and
 * stores it in the `rsvp` table.
 */

header('Content-Type: application/json');
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid submission.']);
    exit;
}

$fullName   = trim((string)($data['full_name'] ?? ''));
$phone      = trim((string)($data['phone'] ?? ''));
$attending  = trim((string)($data['attending'] ?? ''));
$guests     = trim((string)($data['guests'] ?? ''));
$partyNames = trim((string)($data['party_names'] ?? ''));
$message    = trim((string)($data['message'] ?? ''));

// Maximum guests allowed across ALL confirmed ("yes") RSVPs combined.
const MAX_TOTAL_GUESTS = 200;

// ---- Validation ----
if ($fullName === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Please enter your name.']);
    exit;
}
if (mb_strlen($fullName) > 150) {
    $fullName = mb_substr($fullName, 0, 150);
}
if (!in_array($attending, ['yes', 'no', 'maybe'], true)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Please tell us whether you can attend.']);
    exit;
}
if (mb_strlen($phone) > 30) {
    $phone = mb_substr($phone, 0, 30);
}
$guestsNum = (int)$guests;
if ($guestsNum < 1) {
    $guestsNum = 1;
}
if ($guestsNum > 20) {
    $guestsNum = 20;
}

// If more than one person is attending in this party, we need every
// companion's full name — one per line, sent from the form's individual
// name fields (one input per companion).
$partyNamesList = [];
if ($guestsNum > 1) {
    $partyNamesList = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $partyNames)), function ($n) {
        return $n !== '';
    }));
    if (count($partyNamesList) < $guestsNum - 1) {
        http_response_code(422);
        echo json_encode(['success' => false, 'error' => 'Please enter the full name of everyone coming with you.']);
        exit;
    }
    // Keep it sane — cap the stored list at 20 names, matching the guest cap above.
    $partyNamesList = array_slice($partyNamesList, 0, 20);
    foreach ($partyNamesList as &$n) {
        if (mb_strlen($n) > 150) {
            $n = mb_substr($n, 0, 150);
        }
    }
    unset($n);
}
$partyNamesStored = $partyNamesList ? implode("\n", $partyNamesList) : null;

if (mb_strlen($message) > 2000) {
    $message = mb_substr($message, 0, 2000);
}

try {
    $pdo = get_db_connection();

    // ---- Enforce the 200-total-guest cap, only for confirmed ("yes") RSVPs ----
    if ($attending === 'yes') {
        $stmt = $pdo->query("SELECT COALESCE(SUM(guests), 0) FROM rsvp WHERE attending = 'yes'");
        $currentTotal = (int)$stmt->fetchColumn();
        if ($currentTotal + $guestsNum > MAX_TOTAL_GUESTS) {
            http_response_code(422);
            echo json_encode([
                'success' => false,
                'error'   => "We're so sorry — we've reached our full capacity of " . MAX_TOTAL_GUESTS . " guests and can't accept any more confirmed RSVPs. Please reach out to the couple directly.",
            ]);
            exit;
        }
    }

    $stmt = $pdo->prepare(
        'INSERT INTO rsvp (full_name, phone, guests, party_names, message, attending)
         VALUES (:full_name, :phone, :guests, :party_names, :message, :attending)'
    );
    $stmt->execute([
        ':full_name'   => $fullName,
        ':phone'       => $phone !== '' ? $phone : null,
        ':guests'      => $guestsNum,
        ':party_names' => $partyNamesStored,
        ':message'     => $message !== '' ? $message : null,
        ':attending'   => $attending,
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'DB Error: ' . $e->getMessage()]);
}
