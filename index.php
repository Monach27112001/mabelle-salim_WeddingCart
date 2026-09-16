<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<title>Mabelle & Salim — 31.08.2026</title>
<meta name="description" content="Join Mabelle and Salim as they begin their new chapter — 31st August 2026, La Pinède, Kousba.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&family=Noto+Naskh+Arabic:wght@400;600;700&family=Amiri:ital,wght@0,400;0,700;1,400&family=Aref+Ruqaa:wght@400;700&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#f7f4ee;
    --gold:#b68a45;
    --gold-light:#d9bd85;
    --brown:#5a3b25;
    --text:#3f2a1f;
    --card:rgba(255,255,255,.6);
    --radius:24px;
    --ease: cubic-bezier(.22,1,.36,1);
    --shadow: 0 20px 60px -20px rgba(90,59,37,.35);
    --dur-scroll: 1s;
  }

  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    background:var(--bg);
    color:var(--text);
    font-family:'Cormorant Garamond', serif;
    overflow-x:hidden;
    cursor:auto;
  }
  h1,h2,h3, .script{
    font-family:'Great Vibes', cursive;
    font-weight:400;
    color:var(--brown);
  }
  button, .btn-font{ font-family:'Poppins', sans-serif; }
  ::selection{ background:var(--gold-light); color:var(--brown); }

  /* ---------- grain ---------- */
  .grain{
    position:fixed; inset:0; pointer-events:none; z-index:2;
    opacity:.035; mix-blend-mode:multiply;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    animation: grain-shift 8s steps(6) infinite;
  }
  @keyframes grain-shift{
    0%{transform:translate(0,0);} 20%{transform:translate(-2%,2%);}
    40%{transform:translate(2%,-2%);} 60%{transform:translate(-1%,-1%);}
    80%{transform:translate(1%,2%);} 100%{transform:translate(0,0);}
  }

  /* ---------- ambient sparkle background (whole site, all devices) ---------- */
  #sparkle-canvas{
    position:fixed; inset:0; width:100vw; height:100vh;
    pointer-events:none; z-index:6;
    opacity:0; transition:opacity 1.4s ease;
  }
  #sparkle-canvas.on{ opacity:1; }

  /* ---------- cursor glow (desktop only) ---------- */
  #cursor-glow{
    position:fixed; width:340px; height:340px; border-radius:50%;
    pointer-events:none; z-index:9999; left:0; top:0;
    background:radial-gradient(circle, rgba(182,138,69,.16) 0%, rgba(182,138,69,0) 70%);
    transform:translate(-50%,-50%);
    transition:opacity .3s ease;
    opacity:0;
  }
  .particle{
    position:fixed; width:4px; height:4px; border-radius:50%;
    background:var(--gold); pointer-events:none; z-index:9998;
    box-shadow:0 0 6px 1px rgba(182,138,69,.8);
  }

  /* ---------- loader ---------- */
  #loader{
    position:fixed; inset:0; background:#ffffff; z-index:10000;
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    gap:22px; transition:opacity 1s var(--ease), visibility 1s;
  }
  #loader.hide{ opacity:0; visibility:hidden; }
  .ring-spin{
    width:56px; height:56px; border-radius:50%;
    border:2px solid rgba(182,138,69,.2);
    border-top-color:var(--gold);
    animation:spin 1.1s linear infinite;
  }
  @keyframes spin{ to{ transform:rotate(360deg); } }
  #loader p{
    font-family:'Poppins', sans-serif; letter-spacing:.12em; font-size:12px;
    text-transform:uppercase; color:var(--brown); opacity:.7;
  }

  /* ============ SECTION 1 : ENVELOPE ============ */
  #envelope-section{
    position:relative; height:100svh; width:100%;
    background:var(--bg);
    display:flex; align-items:center; justify-content:center;
    overflow:hidden;
  }
  .envelope-wrap{
    position:relative; width:min(88vw,460px); aspect-ratio:890/673;
    display:flex; align-items:center; justify-content:center;
    transition:opacity 1s var(--ease), transform 1s var(--ease), filter 1s var(--ease);
  }
  .envelope-wrap.vanish{
    opacity:0; transform:scale(.92) translateY(-24px); filter:blur(10px);
    pointer-events:none;
  }
  /* the envelope photo is placed edge-to-edge with a soft feathered mask
     so its cream tone dissolves straight into the page background instead
     of showing a hard rectangular edge */
  .envelope-photo{
    position:absolute; inset:0; width:100%; height:100%;
    display:block; object-fit:contain;
    -webkit-mask-image:radial-gradient(ellipse 78% 82% at center, #000 62%, transparent 100%);
    mask-image:radial-gradient(ellipse 78% 82% at center, #000 62%, transparent 100%);
    filter:drop-shadow(0 18px 40px rgba(90,59,37,.14));
  }
  .seal-group{
    position:absolute; left:50%; top:66%; transform:translate(-50%,-50%);
    width:25%; cursor:pointer; z-index:5; border:none; background:none; padding:0;
    transition:transform 1.1s cubic-bezier(.34,1.56,.64,1), opacity .6s ease, filter .3s ease;
    filter:drop-shadow(0 2px 4px rgba(63,42,21,.28));
  }
  .seal-group:hover{ filter:drop-shadow(0 2px 4px rgba(63,42,21,.28)) brightness(1.06); transform:translate(-50%,-50%) scale(1.04); }
  .seal-group.lift{ transform:translate(-50%,-50%) scale(.8) rotate(-8deg); opacity:0; }
  .seal-group.hide{ opacity:0; pointer-events:none; }
  /* multiply-blend the seal onto the paper so it reads as pressed into
     the envelope rather than pasted on top of it */
  .seal-photo{ width:100%; height:auto; display:block; mix-blend-mode:multiply; }
  .envelope-caption{
    position:absolute; bottom:9%; left:50%; transform:translate(-50%,0);
    text-align:center; width:100%; z-index:4;
    opacity:1; transition:opacity .6s ease;
  }
  .envelope-caption h2{ font-size:clamp(26px,4.8vw,36px); color:var(--gold); margin:0; line-height:1.35; text-shadow:0 2px 12px rgba(255,255,255,.6); }
  .envelope-hint{
    position:absolute; bottom:3%; left:50%; transform:translate(-50%,0);
    font-family:'Poppins',sans-serif; font-size:11px; letter-spacing:.2em; font-weight:500;
    text-transform:uppercase; color:var(--brown); opacity:.65; z-index:4;
    animation:pulse-hint 2.4s ease-in-out infinite;
  }
  @keyframes pulse-hint{ 0%,100%{opacity:.4;} 50%{opacity:.8;} }

  #envelope-section.opened .envelope-caption,
  #envelope-section.opened .envelope-hint{ opacity:0; }

  /* a soft white veil that sweeps over the whole viewport as the seal is
     tapped, fading the envelope scene into the details underneath */
  #envelope-fade{
    position:fixed; inset:0; z-index:20; background:var(--bg);
    opacity:0; pointer-events:none; transition:opacity 1.1s var(--ease);
  }
  #envelope-fade.on{ opacity:1; }

  /* subtle vignette so the envelope reads clearly as the one focal object */
  #envelope-section::before{
    content:''; position:absolute; inset:0; pointer-events:none; z-index:0;
    background:radial-gradient(ellipse at center, rgba(255,253,247,.9) 0%, rgba(244,241,234,.4) 45%, rgba(210,198,170,.35) 100%);
  }
  .envelope-wrap{ position:relative; z-index:1; }

  /* ---------- background music toggle ---------- */
  /* Hidden until the envelope is opened, then sits fixed in the bottom-left
     corner for the rest of the visit. Music is ON by default the moment the
     envelope opens; tapping the button only toggles it off/on afterwards. */
  .music-toggle{
    position:fixed; left:22px; bottom:22px; z-index:50;
    width:52px; height:52px; border-radius:50%; border:1px solid rgba(182,138,69,.35);
    background:var(--card); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px);
    box-shadow:0 10px 28px -10px rgba(90,59,37,.4);
    display:flex; align-items:center; justify-content:center; cursor:pointer;
    opacity:0; transform:translateY(14px) scale(.85); pointer-events:none;
    transition:opacity .7s var(--ease), transform .7s var(--ease), box-shadow .3s ease;
  }
  .music-toggle.show{ opacity:1; transform:translateY(0) scale(1); pointer-events:auto; }
  .music-toggle:hover{ box-shadow:0 14px 34px -10px rgba(90,59,37,.5); }
  .music-toggle:focus-visible{ outline:2px solid var(--gold); outline-offset:3px; }
  .music-toggle svg{ width:22px; height:22px; }
  .music-bars{ display:flex; align-items:flex-end; gap:3px; height:18px; }
  .music-bars span{
    display:block; width:3px; background:var(--gold); border-radius:2px;
    animation:music-bar 1s ease-in-out infinite;
  }
  .music-bars span:nth-child(1){ height:40%; animation-delay:0s; }
  .music-bars span:nth-child(2){ height:100%; animation-delay:.18s; }
  .music-bars span:nth-child(3){ height:65%; animation-delay:.36s; }
  @keyframes music-bar{ 0%,100%{ transform:scaleY(.4); } 50%{ transform:scaleY(1); } }
  .music-toggle.muted .music-bars span{ animation-play-state:paused; transform:scaleY(.4); opacity:.55; }
  .music-off-icon{ display:none; }
  .music-toggle.muted .music-bars{ display:none; }
  .music-toggle.muted .music-off-icon{ display:block; }

  /* ============ GENERIC SECTION ============ */
  section{ position:relative; width:100%; padding:min(14vw,120px) 6vw; }
  .reveal{
    opacity:0; transform:translateY(46px) scale(.97); filter:blur(6px);
    transition:opacity var(--dur-scroll) var(--ease), transform var(--dur-scroll) var(--ease), filter var(--dur-scroll) var(--ease);
  }
  .reveal.in{ opacity:1; transform:translateY(0) scale(1); filter:blur(0); }

  .center{ display:flex; flex-direction:column; align-items:center; text-align:center; }

  /* ---------- SECTION 2 ---------- */
  #s2{ background:var(--bg); padding-top:0; padding-bottom:min(10vw,90px); overflow:hidden; }
  .s2-inner{ position:relative; width:100%; padding-top:min(9vw,70px); }
  .names{
    font-family:'Great Vibes', cursive; font-weight:400; direction:ltr; line-height:1.35;
    font-size:clamp(50px,10vw,104px); padding:0 4vw; max-width:100%;
    opacity:0; transform:translateY(22px) scale(.92);
    transition:opacity .9s cubic-bezier(.34,1.56,.64,1), transform .9s cubic-bezier(.34,1.56,.64,1);
    background:linear-gradient(100deg, #8a6a2f 0%, #d9b877 30%, #b6873f 65%, #8a6a2f 100%);
    -webkit-background-clip:text; background-clip:text; color:transparent;
    filter:drop-shadow(0 2px 10px rgba(150,110,50,.25));
  }
  .names.in{ opacity:1; transform:translateY(0) scale(1); }
  .names.breathe{ animation:title-breathe 5s ease-in-out infinite; }
  @keyframes title-breathe{ 0%,100%{ letter-spacing:0; } 50%{ letter-spacing:.02em; } }
  .name-and{
    font-size:.55em; vertical-align:.1em; padding:0 .12em;
  }

  .verse-line{
    font-family:'Cormorant Garamond', serif; font-style:italic; font-weight:500; direction:ltr;
    font-size:clamp(17px,3vw,23px); color:var(--gold); opacity:0;
    margin-bottom:.65em; letter-spacing:.01em; transform:translateY(14px);
    transition:opacity .9s var(--ease), transform .9s var(--ease);
    text-shadow:0 0 18px rgba(182,138,69,.35);
    display:inline-flex; align-items:center; gap:.3em; flex-wrap:wrap; justify-content:center;
    max-width:min(92vw,520px); text-align:center; line-height:1.5;
  }
  .verse-line.in{ opacity:.95; transform:translateY(0); }
  .verse-bracket{
    font-family:'Cormorant Garamond',serif; font-weight:700; font-style:normal;
    font-size:1.4em; line-height:1; flex-shrink:0;
    background:linear-gradient(160deg, #f5dfa8 0%, #d9b877 35%, #b6873f 70%, #8a6a2f 100%);
    -webkit-background-clip:text; background-clip:text; color:transparent;
    text-shadow:none;
    filter:drop-shadow(0 1px 6px rgba(150,110,50,.45));
  }
  .verse-text{ padding:0 .1em; }
  .verse-names{ font-weight:700; font-style:normal; color:var(--brown); }

  .invite-line{
    font-family:'Cormorant Garamond',serif; font-style:italic; font-weight:500; font-size:clamp(15px,2.4vw,18px);
    letter-spacing:.01em; color:var(--text); opacity:0; transform:translateY(12px);
    margin:0 0 1.1em; line-height:1.7; max-width:min(88vw,380px); text-align:center;
    transition:opacity .9s var(--ease), transform .9s var(--ease);
  }
  .invite-line.in{ opacity:.82; transform:translateY(0); }

  /* ---------- date, restyled: a two-tier ornamented treatment with a
     large flourished day number and a gold heart between month & year ---------- */
  .the-date-new{
    margin-top:.6em; display:flex; flex-direction:column; align-items:center; gap:.3em;
    opacity:0; transform:translateY(20px);
    transition:opacity .8s var(--ease), transform .8s var(--ease);
  }
  .the-date-new.in{ opacity:1; transform:translateY(0); }
  .the-date-new .date-big{
    font-family:'Great Vibes',cursive; font-weight:400; font-size:clamp(48px,9vw,78px);
    line-height:1; background:linear-gradient(100deg, #8a6a2f 0%, #d9b877 30%, #b6873f 65%, #8a6a2f 100%);
    -webkit-background-clip:text; background-clip:text; color:transparent;
    filter:drop-shadow(0 2px 8px rgba(150,110,50,.3));
  }
  .the-date-new .date-big sup{ font-size:.4em; top:-.6em; }
  .the-date-new .date-row{ display:flex; align-items:center; gap:.5em; }
  .the-date-new .date-line{ width:clamp(14px,3.4vw,28px); height:1px; background:linear-gradient(90deg,transparent,var(--gold-light)); }
  .the-date-new .date-line.right{ background:linear-gradient(90deg,var(--gold-light),transparent); }
  .the-date-new .date-word{
    font-family:'Poppins',sans-serif; font-size:clamp(12px,2vw,14px); letter-spacing:.32em;
    text-transform:uppercase; color:var(--gold); font-weight:500;
  }
  .date-heart-icon{
    width:clamp(12px,2vw,15px); height:auto; flex-shrink:0;
    animation:date-heart-pulse 2.2s ease-in-out infinite;
  }
  @keyframes date-heart-pulse{ 0%,100%{ transform:scale(1);} 50%{ transform:scale(1.22);} }

  .rings{
    margin-top:2.2em; width:min(46vw,190px);
    opacity:0; transform:scale(.5);
    transition:opacity .8s var(--ease), transform .8s var(--ease);
  }
  .rings.in{ opacity:1; transform:scale(1); }
  .ring-shine-a, .ring-shine-b{ animation:ring-glint 3.6s ease-in-out infinite; }
  .ring-shine-b{ animation-delay:1.1s; }
  @keyframes ring-glint{ 0%,100%{opacity:0;} 45%,55%{opacity:.9;} }

  /* couple illustration — already has a transparent background, so it
     merges into the page naturally with no mask/blend trick needed */
  .couple-wrap{
    margin-top:2em; width:min(62vw,340px);
    opacity:0; transform:translateY(34px);
    transition:opacity 1.2s var(--ease), transform 1.2s var(--ease);
  }
  .couple-wrap.in{ opacity:1; transform:translateY(0); }
  .couple-photo{
    display:block; width:100%; height:auto; animation:float-y 6s ease-in-out infinite;
    filter:drop-shadow(0 16px 26px rgba(90,59,37,.16));
  }
  @keyframes float-y{ 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }

  /* ---------- SECTION 3 : a simple ornamented divider into the details ---------- */
  #s3{ background:var(--bg); padding-top:0; padding-bottom:min(6vw,50px); }
  .vine-border{
    margin-top:0; width:min(92vw,420px);
    padding:2.2em 1.4em; position:relative; text-align:center;
  }
  .vine-border .script{ position:relative; font-size:clamp(24px,4vw,30px); z-index:1; }

  /* ---------- SECTION : SCHEDULE (details) ---------- */
  #schedule{ background:var(--bg); }
  .schedule-title{ font-size:clamp(34px,6vw,50px); margin:0 0 1em; }
  .schedule-grid{
    display:flex; flex-direction:column; align-items:center; gap:1.6em;
    width:100%; max-width:420px;
  }
  .schedule-card{
    width:100%; background:var(--card); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px);
    border:1px solid rgba(182,138,69,.25); border-radius:var(--radius);
    box-shadow:var(--shadow); padding:2.2em 1.6em; text-align:center;
    transition:transform .4s var(--ease), box-shadow .4s var(--ease);
  }
  .schedule-card:hover{ transform:translateY(-4px); box-shadow:0 26px 70px -18px rgba(182,138,69,.4); }
  .schedule-icon{ width:44px; height:44px; margin-bottom:.7em; }
  .schedule-card h4{
    font-family:'Great Vibes',cursive; font-weight:400; color:var(--brown);
    font-size:clamp(26px,4.4vw,32px); margin:0 0 .5em;
  }
  .schedule-time{ font-size:clamp(16px,2.6vw,18px); color:var(--text); margin:.15em 0; opacity:.85; }
  .schedule-place{ font-size:clamp(15px,2.4vw,17px); color:var(--gold); margin:.15em 0; }
  /* the venue name and the RSVP line are set in wide, formal
     letter-spaced caps rather than a normal sentence */
  .schedule-spaced{ letter-spacing:.28em; text-transform:uppercase; }
  .schedule-note{
    font-family:'Poppins',sans-serif; font-size:clamp(11px,2vw,12.5px); font-weight:500;
    letter-spacing:.32em; text-transform:uppercase; color:var(--brown); opacity:.7;
    margin-top:1.1em;
  }
  .map-btn{
    display:inline-block; margin-top:1.1em; padding:.75em 1.6em;
    border:1px solid var(--gold); border-radius:10px; color:var(--brown);
    font-family:'Poppins',sans-serif; font-size:12.5px; letter-spacing:.08em; text-transform:uppercase;
    text-decoration:none; transition:background .3s ease, color .3s ease, transform .3s ease;
  }
  .map-btn:hover{ background:var(--gold); color:#fff; transform:translateY(-2px); }

  /* ---------- SECTION 4 : RSVP ---------- */
  #s4{ background:linear-gradient(180deg,var(--bg),#f2ede2); }
  .rsvp-card{
    background:var(--card); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px);
    border:1px solid rgba(182,138,69,.22); border-radius:var(--radius);
    box-shadow:var(--shadow); padding:clamp(2em,5vw,3em); width:min(92vw,460px);
    animation:rsvp-float 6s ease-in-out infinite;
  }
  @keyframes rsvp-float{ 0%,100%{ transform:translateY(0);} 50%{ transform:translateY(-10px);} }
  .rsvp-card h3{ font-size:clamp(30px,5vw,40px); margin:0 0 .2em; }
  .rsvp-sub{ opacity:.8; margin-bottom:1.4em; font-style:italic; }
  .rsvp-guest{ font-size:clamp(19px,3vw,22px); font-weight:600; color:var(--brown); margin:1.2em 0 .8em; text-align:left; }
  .radio-row{ display:flex; flex-direction:column; gap:.7em; align-items:flex-start; margin-bottom:1.4em; }
  .radio-opt{ display:flex; align-items:center; gap:.7em; cursor:pointer; font-size:18px; }
  .radio-opt input{ appearance:none; width:20px; height:20px; border-radius:50%; border:2px solid var(--brown); position:relative; margin:0; cursor:pointer; transition:box-shadow .2s ease; }
  .radio-opt input:checked{ box-shadow:inset 0 0 0 5px var(--brown); }
  .radio-opt input:focus-visible{ outline:2px solid var(--gold); outline-offset:2px; }

  .field-label{ display:block; text-align:left; font-family:'Poppins',sans-serif; font-size:12px; letter-spacing:.08em; text-transform:uppercase; color:var(--brown); margin-bottom:.5em; opacity:.75; }
  .rsvp-input{
    width:100%; padding:.85em 1em; border-radius:12px; border:1px solid rgba(90,59,37,.25);
    background:rgba(255,255,255,.7); font-family:'Cormorant Garamond',serif; font-size:18px; color:var(--text);
    margin-bottom:1.4em; resize:vertical;
  }
  .rsvp-input:focus-visible{ outline:2px solid var(--gold); }
  select{
    width:100%; padding:.85em 1em; border-radius:12px; border:1px solid rgba(90,59,37,.25);
    background:rgba(255,255,255,.7); font-family:'Cormorant Garamond',serif; font-size:18px; color:var(--text);
    margin-bottom:1.6em; cursor:pointer;
  }
  select:focus-visible{ outline:2px solid var(--gold); }
  .party-names-wrap{ margin-top:-0.6em; }
  #party-names-fields{ display:flex; flex-direction:column; gap:.6em; margin-top:.4em; }
  #party-names-fields input{ width:100%; box-sizing:border-box; }

  .btn-send{
    position:relative; overflow:hidden; width:100%; padding:1em; border:none; border-radius:14px;
    background:linear-gradient(120deg,var(--brown),var(--gold),var(--brown)); background-size:220% 220%;
    color:#fff; font-size:15px; letter-spacing:.1em; text-transform:uppercase; cursor:pointer;
    transition:transform .3s var(--ease), box-shadow .3s var(--ease), background-position .8s ease;
    box-shadow:0 12px 30px -10px rgba(90,59,37,.55);
  }
  .btn-send:hover{ transform:translateY(-3px); background-position:100% 50%; box-shadow:0 18px 40px -12px rgba(90,59,37,.65); }
  .btn-send:focus-visible{ outline:2px solid var(--gold); outline-offset:3px; }
  .ripple{ position:absolute; border-radius:50%; background:rgba(255,255,255,.55); transform:scale(0); animation:ripple-anim .65s ease-out; pointer-events:none; }
  @keyframes ripple-anim{ to{ transform:scale(3.2); opacity:0; } }

  .rsvp-msg{ margin-top:1em; font-family:'Poppins',sans-serif; font-size:13px; color:var(--brown); opacity:0; transition:opacity .5s ease; }
  .rsvp-msg.show{ opacity:1; }
  .rsvp-error{ color:#a94442; }
  .btn-send[disabled]{ opacity:.6; cursor:not-allowed; }

  /* live inline note shown the moment "Maybe" or "Sorry, I can't" is
     picked, before the form is even submitted */
  .attend-note{
    display:none; margin:-0.6em 0 1.4em; padding:.9em 1.1em; border-radius:12px;
    background:rgba(182,138,69,.12); border:1px solid rgba(182,138,69,.3);
    font-family:'Cormorant Garamond',serif; font-style:italic; font-size:16px;
    color:var(--brown); text-align:left; line-height:1.5;
  }
  .attend-note.show{ display:block; }

  /* ---------- SECTION 5 : GIFT ---------- */
  #s5{ background:#f2ede2; }
  .gift-icon{
    display:block; width:min(34vw,140px); height:auto; margin:0 auto;
    animation:float-y 5s ease-in-out infinite;
    filter:drop-shadow(0 10px 18px rgba(90,59,37,.14));
  }
  .gift-title{ font-size:clamp(30px,5vw,40px); margin:.5em 0 .1em; font-weight:600; font-family:'Cormorant Garamond',serif;}
  .gift-info p{ margin:.2em 0; font-size:clamp(17px,2.6vw,20px); }
  .gift-note{
    max-width:440px; margin:0 auto 1.4em; font-style:italic; color:#8a6a2f; font-weight:600;
    font-size:clamp(15px,2.3vw,18px); line-height:1.6;
  }
  .walking-wrap{ width:min(66vw,300px); margin-top:2.6em; }
  .walking-photo{
    display:block; width:100%; height:auto; animation:float-y 7s ease-in-out infinite;
    -webkit-mask-image:radial-gradient(ellipse 82% 86% at center, #000 58%, transparent 100%);
    mask-image:radial-gradient(ellipse 82% 86% at center, #000 58%, transparent 100%);
    filter:drop-shadow(0 16px 26px rgba(90,59,37,.16));
  }
  .quote{
    margin-top:2em; font-family:'Great Vibes',cursive; color:var(--gold);
    font-size:clamp(26px,5vw,38px); line-height:1.35; max-width:640px;
  }
  footer{ text-align:center; padding:3em 1em 4em; font-family:'Poppins',sans-serif; font-size:11px; letter-spacing:.14em; text-transform:uppercase; color:var(--brown); opacity:.5; }

  @media (max-width:640px){
    section{ padding:18vw 6vw; }
    .radio-row{ align-items:stretch; }

    /* on mobile the illustration stays a centered floating cutout — same
       idea as desktop, just full responsive width — rather than a full-bleed
       cover photo (that treatment was for a rectangular photograph, not a
       transparent illustration) */
    #s2{ padding-left:6vw; padding-right:6vw; }
    .s2-inner{ padding-top:10vw; }
    .couple-wrap{ width:min(84vw,420px); margin-top:1.4em; }

    /* more breathing room below the rings before the couple illustration */
    .rings{ margin-bottom:1.2em; }

    .music-toggle{ left:16px; bottom:16px; width:46px; height:46px; }
  }

  @media (prefers-reduced-motion: reduce){
    *{ animation-duration:.001ms !important; animation-iteration-count:1 !important; transition-duration:.001ms !important; scroll-behavior:auto !important; }
  }

  .sr-only{ position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap; }
</style>
</head>
<body>

<div class="grain" aria-hidden="true"></div>
<div id="cursor-glow" aria-hidden="true"></div>
<canvas id="sparkle-canvas" aria-hidden="true"></canvas>

<div id="loader" role="status" aria-live="polite">
  <div class="ring-spin"></div>
  <p>Loading Invitation…</p>
</div>

<!-- ============ BACKGROUND MUSIC ============ -->
<!-- Drop your track at audio/wedding-song.mp3 (any royalty-free mp3 works).
     Hidden until the envelope opens; ON by default from that moment,
     the button only toggles it afterwards. -->
<audio id="bg-music" src="audio/A Thousand Years.mp3" loop preload="none"></audio>
<button type="button" id="music-toggle" class="music-toggle" aria-label="Turn background music off" aria-pressed="true">
  <span class="music-bars" aria-hidden="true"><span></span><span></span><span></span></span>
  <svg class="music-off-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <path d="M9 17V6.6L19 4v10.4" stroke="var(--brown)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="6.5" cy="17" r="2.5" stroke="var(--brown)" stroke-width="1.6"/>
    <circle cx="16.5" cy="14.4" r="2.5" stroke="var(--brown)" stroke-width="1.6"/>
    <path d="M3 3l18 18" stroke="var(--brown)" stroke-width="1.6" stroke-linecap="round"/>
  </svg>
</button>

<!-- ============ SECTION 1 : ENVELOPE ============ -->
<section id="envelope-section" aria-label="Wedding invitation envelope, tap the seal to open">
  <div class="envelope-wrap">
    <picture>
      <source srcset="images/envelope.png" type="image/webp">
      <img class="envelope-photo" src="images/envelope.png" alt="Cream ornamented envelope" draggable="false">
    </picture>

    <button class="seal-group" id="wax-seal" type="button" aria-label="Open invitation">
      <picture>
        <source srcset="images/wax-seal.png" type="image/webp">
        <img class="seal-photo" src="images/wax-seal.png" alt="M&amp;S gold wax seal" draggable="false">
      </picture>
    </button>
  </div>

  <div class="envelope-caption"><h2>Join us as we begin this<br>new chapter.</h2></div>
  <div class="envelope-hint">Tap the seal to open</div>
</section>

<div id="envelope-fade" aria-hidden="true"></div>

<!-- ============ SECTION 2 ============ -->
<section id="s2">
  <div class="s2-inner center">
    <p class="verse-line" id="verse-line" dir="ltr" lang="en"><span class="verse-bracket">﴾</span><span class="verse-text">With Love &amp; Joy<br></span><span class="verse-bracket">﴿</span></p>
    <p class="invite-line" id="invite-line">We invite you to share our happiness<br>and celebrate our marriage</p>
    <h1 class="names" id="names-title" dir="ltr" lang="en">Mabelle <span class="name-and">&amp;</span> Salim</h1>
    <div class="the-date-new" id="the-date">
      <span class="date-big">30<sup>th</sup></span>
      <span class="date-row">
        <span class="date-line" aria-hidden="true"></span>
        <span class="date-word">August</span>
        <svg class="date-heart-icon" viewBox="0 0 32 29" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path fill="url(#dateHeartGrad)" d="M23.6 0c-3.4 0-6.3 2-7.6 4.9C14.7 2 11.8 0 8.4 0 3.8 0 0 3.8 0 8.4c0 9.3 12.8 14.9 15.6 16.6.2.1.4.1.6.1.2 0 .4 0 .6-.1C19.6 23.3 32 17.7 32 8.4 32 3.8 28.2 0 23.6 0z"/>
          <defs>
            <linearGradient id="dateHeartGrad" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0" stop-color="#f5dfa8"/>
              <stop offset="0.5" stop-color="#c99a4e"/>
              <stop offset="1" stop-color="#8a6a2f"/>
            </linearGradient>
          </defs>
        </svg>
        <span class="date-word">2026</span>
        <span class="date-line right" aria-hidden="true"></span>
      </span>
    </div>

    <svg class="rings" id="rings-svg" viewBox="0 0 200 110" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Two interlocking gold wedding rings">
      <defs>
        <linearGradient id="ringGradA" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0" stop-color="#f5e3ba"/>
          <stop offset="0.28" stop-color="#d9b062"/>
          <stop offset="0.55" stop-color="#a97a3a"/>
          <stop offset="0.78" stop-color="#e2c383"/>
          <stop offset="1" stop-color="#8a6530"/>
        </linearGradient>
        <linearGradient id="ringGradB" x1="1" y1="0" x2="0" y2="1">
          <stop offset="0" stop-color="#fdf0cf"/>
          <stop offset="0.3" stop-color="#e3bd72"/>
          <stop offset="0.6" stop-color="#b0813f"/>
          <stop offset="1" stop-color="#8a6530"/>
        </linearGradient>
        <filter id="ringShadow" x="-50%" y="-50%" width="200%" height="200%">
          <feDropShadow dx="0" dy="6" stdDeviation="4" flood-color="#5a3b25" flood-opacity="0.28"/>
        </filter>
      </defs>
      <g filter="url(#ringShadow)">
        <circle cx="78" cy="60" r="33" fill="none" stroke="url(#ringGradA)" stroke-width="10"/>
        <circle cx="122" cy="48" r="33" fill="none" stroke="url(#ringGradB)" stroke-width="10"/>
      </g>
      <path d="M58 38 A33 33 0 0 1 88 33" fill="none" stroke="#fff" stroke-width="1.6" opacity=".55" stroke-linecap="round"/>
      <path d="M108 20 A33 33 0 0 1 140 22" fill="none" stroke="#fff" stroke-width="1.6" opacity=".6" stroke-linecap="round"/>
      <ellipse class="ring-shine-a" cx="62" cy="38" rx="7" ry="3" fill="#fff" opacity="0"/>
      <ellipse class="ring-shine-b" cx="134" cy="26" rx="7" ry="3" fill="#fff" opacity="0"/>
    </svg>

    <div class="couple-wrap" id="couple-wrap">
      <picture>
        <source srcset="images/couple-illustration.png" type="image/webp">
        <img class="couple-photo" src="images/couple-illustration.png" alt="Mabelle and Salim">
      </picture>
    </div>
  </div>
</section>

<!-- ============ SECTION 3 ============ -->
<section id="s3">
  <div class="center">
    <div class="vine-border reveal">
      <span class="script">We Can't Wait To Celebrate With You</span>
    </div>
  </div>
</section>

<!-- ============ SECTION : SCHEDULE (details) ============ -->
<section id="schedule">
  <div class="center">
    <h2 class="script schedule-title reveal">The Details</h2>
    <div class="schedule-grid">

      <div class="schedule-card reveal">
        <svg class="schedule-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M24 44s14-12.6 14-23A14 14 0 0 0 10 21c0 10.4 14 23 14 23z" stroke="var(--gold)" stroke-width="1.6" stroke-linejoin="round"/>
          <circle cx="24" cy="21" r="5" stroke="var(--gold)" stroke-width="1.6"/>
        </svg>
        <h4>Location</h4>
        <p class="schedule-place schedule-spaced">La Pinède, Kousba</p>
        <a class="map-btn btn-font" href="https://www.google.com/maps/search/?api=1&query=La%20Pin%C3%A8de%20Kousba%20Lebanon" target="_blank" rel="noopener">View on Google Maps</a>
      </div>

      <div class="schedule-card reveal">
        <svg class="schedule-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M15 8c0 8 3 13 9 15v13" stroke="var(--gold)" stroke-width="1.6" stroke-linecap="round"/>
          <path d="M33 8c0 8-3 13-9 15" stroke="var(--gold)" stroke-width="1.6" stroke-linecap="round"/>
          <path d="M15 8h18" stroke="var(--gold)" stroke-width="1.6" stroke-linecap="round"/>
          <path d="M17 40h14" stroke="var(--gold)" stroke-width="1.6" stroke-linecap="round"/>
        </svg>
        <h4>Dinner</h4>
        <p class="schedule-time schedule-spaced">8:00 PM</p>
      </div>

    </div>
  </div>
</section>

<!-- ============ SECTION 4 : RSVP ============ -->
<section id="s4">
  <div class="center">
    <form class="rsvp-card reveal" id="rsvp-form" novalidate>
      <h3>Be Our Guest</h3>
      <p class="rsvp-sub">Your presence would be precious.</p>

      <label class="field-label" for="guest-name">Full name</label>
      <input class="rsvp-input" type="text" id="guest-name" name="name" placeholder="Your name" required>

      <label class="field-label" for="guest-phone">Phone number</label>
      <input class="rsvp-input" type="tel" id="guest-phone" name="phone" placeholder="So we can reach you">

      <div class="radio-row" role="radiogroup" aria-label="Will you attend?">
        <label class="radio-opt"><input type="radio" name="attend" value="yes" checked> Count me in!</label>
        <label class="radio-opt"><input type="radio" name="attend" value="maybe"> Maybe</label>
        <label class="radio-opt"><input type="radio" name="attend" value="no"> Sorry, I can't</label>
      </div>

      <p class="attend-note" id="attend-note"></p>

      <label class="field-label" for="guests">Is someone coming with you?</label>
      <select id="guests" name="guests">
        <option value="1" selected>Just me</option>
        <option value="2">2 people (included me)</option>
        <option value="3">3 people (included me)</option>
        <option value="4">4 people (included me)</option>
        <option value="5">5 people (included me)</option>
        <option value="6">6 people (included me)</option>
      </select>

      <div id="party-names-wrap" class="party-names-wrap" hidden>
        <label class="field-label">Full name of everyone coming with you</label>
        <div id="party-names-fields"></div>
      </div>

      <label class="field-label" for="guest-message">Message (optional)</label>
      <textarea class="rsvp-input" id="guest-message" name="message" rows="2" placeholder="A note for the couple"></textarea>

      <button type="submit" class="btn-send">Send</button>
      <p class="rsvp-msg" id="rsvp-msg">Thank you — we can't wait to celebrate with you.</p>
      <p class="rsvp-msg rsvp-error" id="rsvp-error">Something went wrong — please try again.</p>
    </form>
  </div>
</section>

<!-- ============ SECTION 5 : GIFT ============ -->
<section id="s5">
  <div class="center">
    <picture>
      <source srcset="images/gift-box.png" type="image/webp">
      <img class="gift-icon reveal" src="images/gift-box.png" alt="Gift box tied with a gold ribbon and an M&amp;S wax seal tag" loading="lazy">
    </picture>

    <h3 class="gift-title reveal">Whish Money</h3>
    <p class="gift-note reveal">Your presence is our gift. If you wish to contribute financially, it is welcome but completely optional.</p>
    <div class="gift-info reveal">
      <p>Name: Mabelle &amp; Salim</p>
      <p>Phone: +961 71 123 109</p>
      <p>Account ID: 20353783-03</p>
    </div>

    <div class="walking-wrap reveal">
      <picture>
        <source srcset="images/walking-couple.png" type="image/webp">
        <img class="walking-photo" src="images/walking-couple.png" alt="Mabelle and Salim walking away together, hand in hand" loading="lazy">
      </picture>
    </div>

    <p class="quote reveal">welcome to our love story</p>
  </div>
  <footer>Mabelle &amp; Salim · Sunday 30 August 2026</footer>
</section>

<script>
(function(){
  "use strict";
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Loader ---------- */
  window.addEventListener('load', function(){
    setTimeout(function(){
      document.getElementById('loader').classList.add('hide');
    }, 700);
  });

  /* ---------- Cursor glow + particles (desktop only) ---------- */
  var isDesktop = window.matchMedia('(pointer:fine)').matches;
  if(isDesktop && !reduced){
    var glow = document.getElementById('cursor-glow');
    var lastP = 0;
    window.addEventListener('mousemove', function(e){
      glow.style.opacity = '1';
      glow.style.left = e.clientX + 'px';
      glow.style.top = e.clientY + 'px';
      var now = Date.now();
      if(now - lastP > 90){
        lastP = now;
        spawnParticle(e.clientX, e.clientY);
      }
    });
    document.addEventListener('mouseleave', function(){ glow.style.opacity = '0'; });

    function spawnParticle(x,y){
      var p = document.createElement('div');
      p.className = 'particle';
      p.style.left = (x + (Math.random()*20-10)) + 'px';
      p.style.top = (y + (Math.random()*20-10)) + 'px';
      document.body.appendChild(p);
      var life = 700 + Math.random()*400;
      var start = performance.now();
      function frame(t){
        var prog = (t - start)/life;
        if(prog >= 1){ p.remove(); return; }
        p.style.opacity = String(1 - prog);
        p.style.transform = 'translateY(' + (-prog*30) + 'px)';
        requestAnimationFrame(frame);
      }
      requestAnimationFrame(frame);
    }
  }

  /* ---------- Ambient sparkle background (all devices) ---------- */
  /* Runs from the moment the envelope opens through the rest of the site.
     Uses one fixed full-viewport canvas so it keeps sparkling as the
     visitor scrolls, without re-rendering per section. */
  var sparkleCanvas = document.getElementById('sparkle-canvas');
  var sparkleStarted = false;
  function startSparkles(){
    if(sparkleStarted || !sparkleCanvas) return;
    sparkleStarted = true;

    if(reduced){
      /* respect reduced-motion: show a faint static sparkle field, no animation */
      sparkleCanvas.classList.add('on');
      return;
    }

    var ctx = sparkleCanvas.getContext('2d');
    var DPR = Math.min(window.devicePixelRatio || 1, 2);
    var W, H;

    function resize(){
      W = window.innerWidth;
      H = window.innerHeight;
      sparkleCanvas.width = W * DPR;
      sparkleCanvas.height = H * DPR;
      sparkleCanvas.style.width = W + 'px';
      sparkleCanvas.style.height = H + 'px';
      ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
    }
    resize();
    window.addEventListener('resize', resize);

    var count = window.innerWidth < 700 ? 95 : 170;
    var palette = [
      'rgba(255,255,255,ALPHA)',   /* pure white */
      'rgba(250,240,220,ALPHA)',   /* warm white */
      'rgba(240,215,165,ALPHA)',   /* pale gold */
      'rgba(240,215,165,ALPHA)',   /* pale gold (weighted) */
      'rgba(212,175,110,ALPHA)',   /* classic gold */
      'rgba(212,175,110,ALPHA)',   /* classic gold (weighted) */
      'rgba(191,149,74,ALPHA)'     /* deeper gold */
    ];
    var sparkles = [];
    for(var i = 0; i < count; i++){
      sparkles.push({
        x: Math.random() * W,
        y: Math.random() * H,
        r: 0.5 + Math.random() * 1.3,
        speed: 0.06 + Math.random() * 0.22,
        drift: (Math.random() - 0.5) * 0.14,
        twinkleSpeed: 0.006 + Math.random() * 0.011,
        twinklePhase: Math.random() * Math.PI * 2,
        color: palette[Math.floor(Math.random() * palette.length)]
      });
    }

    function frame(t){
      ctx.clearRect(0, 0, W, H);
      for(var i = 0; i < sparkles.length; i++){
        var s = sparkles[i];
        s.y -= s.speed;
        s.x += s.drift;
        if(s.y < -10){ s.y = H + 10; s.x = Math.random() * W; }
        if(s.x < -10) s.x = W + 10;
        if(s.x > W + 10) s.x = -10;
        var alpha = 0.35 + 0.65 * Math.abs(Math.sin(t * s.twinkleSpeed + s.twinklePhase));
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
        ctx.fillStyle = s.color.replace('ALPHA', alpha.toFixed(3));
        ctx.shadowColor = 'rgba(245,225,180,.95)';
        ctx.shadowBlur = 6;
        ctx.fill();
      }
      requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
    sparkleCanvas.classList.add('on');
  }

  /* ---------- Background music ---------- */
  /* Music is ON by default from the moment the envelope opens. The button
     only appears at that point, and only ever toggles play/pause after. */
  var music = document.getElementById('bg-music');
  var musicToggle = document.getElementById('music-toggle');
  var musicPlaying = false;

  function setMusicUI(playing){
    musicPlaying = playing;
    musicToggle.classList.toggle('muted', !playing);
    musicToggle.setAttribute('aria-pressed', playing ? 'true' : 'false');
    musicToggle.setAttribute('aria-label', playing ? 'Turn background music off' : 'Turn background music on');
  }

  function revealMusicButton(){
    musicToggle.classList.add('show');
    /* Calling play() here happens inside the same user-gesture chain as
       the seal tap, so browsers allow audio to start with sound. */
    var playPromise = music.play();
    if(playPromise && playPromise.then){
      playPromise.then(function(){ setMusicUI(true); })
        .catch(function(){ setMusicUI(false); }); // autoplay blocked — user can tap to start it
    } else {
      setMusicUI(true);
    }
  }

  musicToggle.addEventListener('click', function(){
    if(musicPlaying){
      music.pause();
      setMusicUI(false);
    } else {
      var p = music.play();
      if(p && p.then){ p.then(function(){ setMusicUI(true); }).catch(function(){ setMusicUI(false); }); }
      else { setMusicUI(true); }
    }
  });

  /* ---------- Envelope opening ---------- */
  /* Tapping the wax seal lifts it away, then a soft veil fades the whole
     envelope scene out and reveals the details page underneath. */
  var seal = document.getElementById('wax-seal');
  var envSection = document.getElementById('envelope-section');
  var envWrap = document.querySelector('.envelope-wrap');
  var envFade = document.getElementById('envelope-fade');
  var opened = false;

  function openEnvelope(){
    if(opened) return;
    opened = true;
    envSection.classList.add('opened');
    startSparkles();
    revealMusicButton();

    if(reduced){
      seal.classList.add('lift','hide');
      envWrap.classList.add('vanish');
      document.getElementById('s2').scrollIntoView({behavior:'auto'});
      return;
    }

    /* the seal lifts and fades away first */
    seal.classList.add('lift');
    setTimeout(function(){ seal.classList.add('hide'); }, 500);

    /* the envelope softly dissolves, and a matching veil fades over the
       viewport so the transition to the details below feels seamless */
    setTimeout(function(){
      envWrap.classList.add('vanish');
      envFade.classList.add('on');
    }, 600);

    var scrollDelay = 1500;
    setTimeout(function(){
      document.getElementById('s2').scrollIntoView({behavior:'smooth'});
    }, scrollDelay);

    setTimeout(function(){ envFade.classList.remove('on'); }, scrollDelay + 900);
  }

  seal.addEventListener('click', openEnvelope);
  seal.addEventListener('keydown', function(e){
    if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); openEnvelope(); }
  });

  /* ---------- Names reveal ---------- */
  
  var namesTitle = document.getElementById('names-title');
  var verseLine = document.getElementById('verse-line');
  var inviteLine = document.getElementById('invite-line');

  var theDate = document.getElementById('the-date');
  var ringsSvg = document.getElementById('rings-svg');
  var coupleWrap = document.getElementById('couple-wrap');

  var namesSequenceStarted = false;
  function runNamesSequence(){
    if(namesSequenceStarted) return;
    namesSequenceStarted = true;
    var t = reduced ? 0 : 150;
    setTimeout(function(){ verseLine.classList.add('in'); }, t);
    t += reduced ? 40 : 500;
    setTimeout(function(){ inviteLine.classList.add('in'); }, t);
    t += reduced ? 40 : 500;
    setTimeout(function(){ namesTitle.classList.add('in'); }, t);
    t += reduced ? 40 : 750;
    setTimeout(function(){ theDate.classList.add('in'); }, t);
    setTimeout(function(){ ringsSvg.classList.add('in'); }, t + 550);
    setTimeout(function(){ coupleWrap.classList.add('in'); }, t + 1100);
    setTimeout(function(){ namesTitle.classList.add('breathe'); }, t + 2200);
  }

  /* ---------- Intersection Observer : scroll reveals ---------- */
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('in');
        if(entry.target.id === 's2') runNamesSequence();
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('.reveal').forEach(function(el){ io.observe(el); });
  io.observe(document.getElementById('s2'));

  /* ---------- Parallax ---------- */
  if(!reduced){
    window.addEventListener('scroll', function(){
      var y = window.scrollY;
      envSection.style.backgroundPosition = 'center ' + (y*0.15) + 'px';
      var couple = document.querySelector('.couple-photo');
      if(couple) couple.style.transform = 'translateY(' + (y*0.02) + 'px)';
    }, {passive:true});
  }

  /* ---------- RSVP form ---------- */
  var RSVP_DEADLINE = 'August 18, 2026'; // edit this to change the "maybe" reminder date
  var RSVP_MESSAGES = {
    yes:   "Thank you — we can't wait to celebrate with you.",
    no:    "Thanks for letting us know! We will miss you",
    maybe: "We hope you can make it, but please confirm before 18/8"
  };
  var form = document.getElementById('rsvp-form');
  var msg = document.getElementById('rsvp-msg');
  var errMsg = document.getElementById('rsvp-error');

  /* Live note under the radio buttons — updates the instant "Maybe" or
     "Sorry, I can't" is picked, independent of the after-submit message. */
  var attendNote = document.getElementById('attend-note');
  var attendRadios = form.querySelectorAll('input[name="attend"]');
  function syncAttendNote(){
    var val = form.querySelector('input[name="attend"]:checked').value;
    if(val === 'maybe'){
      attendNote.textContent = RSVP_MESSAGES.maybe;
      attendNote.classList.add('show');
    } else if(val === 'no'){
      attendNote.textContent = RSVP_MESSAGES.no;
      attendNote.classList.add('show');
    } else {
      attendNote.textContent = '';
      attendNote.classList.remove('show');
    }
  }
  attendRadios.forEach(function(r){ r.addEventListener('change', syncAttendNote); });
  syncAttendNote();

  /* Show one "full name" field per companion whenever the headcount is
     more than 1 — regenerated every time the number changes. */
  var guestsSelect = document.getElementById('guests');
  var partyNamesWrap = document.getElementById('party-names-wrap');
  var partyNamesFields = document.getElementById('party-names-fields');

  function syncPartyNamesVisibility(){
    var count = parseInt(guestsSelect.value, 10) || 1;
    var companions = count - 1; // everyone in the party except the person filling the form
    partyNamesWrap.hidden = companions < 1;

    var existing = partyNamesFields.querySelectorAll('input').length;
    if(existing === companions) return; // already correct, keep whatever the user typed

    // Preserve any names already typed, in order, while resizing the field count
    var previousValues = Array.prototype.map.call(partyNamesFields.querySelectorAll('input'), function(el){ return el.value; });
    partyNamesFields.innerHTML = '';
    for(var i = 0; i < companions; i++){
      var input = document.createElement('input');
      input.type = 'text';
      input.className = 'rsvp-input';
      input.placeholder = 'Full name of guest ' + (i + 1);
      input.value = previousValues[i] || '';
      input.setAttribute('data-party-name', '');
      partyNamesFields.appendChild(input);
    }
  }
  guestsSelect.addEventListener('change', syncPartyNamesVisibility);
  syncPartyNamesVisibility();

  form.addEventListener('submit', function(e){
    e.preventDefault();
    errMsg.classList.remove('show');
    var nameField = document.getElementById('guest-name');
    if(!nameField.value.trim()){
      nameField.focus();
      return;
    }
    var guestsVal = parseInt(guestsSelect.value, 10) || 1;
    var companionInputs = Array.prototype.slice.call(partyNamesFields.querySelectorAll('input'));
    var companionNames = companionInputs.map(function(el){ return el.value.trim(); });
    if(guestsVal > 1 && companionNames.some(function(n){ return n === ''; })){
      var firstEmpty = companionInputs.filter(function(el){ return el.value.trim() === ''; })[0];
      if(firstEmpty) firstEmpty.focus();
      errMsg.textContent = "Please enter the full name of everyone coming with you.";
      errMsg.classList.add('show');
      return;
    }
    var btn = form.querySelector('.btn-send');
    btn.disabled = true;
    var originalLabel = btn.textContent;
    btn.textContent = 'Sending…';

    var payload = {
      full_name: nameField.value.trim(),
      phone: document.getElementById('guest-phone').value.trim(),
      attending: form.querySelector('input[name="attend"]:checked').value,
      guests: guestsSelect.value,
      party_names: companionNames.join('\n'),
      message: document.getElementById('guest-message').value.trim()
    };

    fetch('php/rsvp.php', {
      method:'POST',
      headers:{ 'Content-Type':'application/json' },
      body: JSON.stringify(payload)
    })
    .then(function(res){ return res.json().then(function(data){ return { ok:res.ok, data:data }; }); })
    .then(function(result){
      btn.disabled = false;
      btn.textContent = originalLabel;
      if(result.ok && result.data && result.data.success){
        msg.textContent = RSVP_MESSAGES[payload.attending] || RSVP_MESSAGES.yes;
        msg.classList.add('show');
        form.reset();
        partyNamesFields.innerHTML = '';
        syncPartyNamesVisibility();
        syncAttendNote();
      } else {
        errMsg.textContent = (result.data && result.data.error) || "Something went wrong — please try again.";
        errMsg.classList.add('show');
      }
    })
    .catch(function(){
      btn.disabled = false;
      btn.textContent = originalLabel;
      errMsg.textContent = "Couldn't reach the server — please check your connection and try again.";
      errMsg.classList.add('show');
    });
  });

  var sendBtn = document.querySelector('.btn-send');
  sendBtn.addEventListener('click', function(e){
    var rect = sendBtn.getBoundingClientRect();
    var ripple = document.createElement('span');
    ripple.className = 'ripple';
    var size = Math.max(rect.width, rect.height);
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
    ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
    sendBtn.appendChild(ripple);
    setTimeout(function(){ ripple.remove(); }, 700);
  });

})();
</script>
</body>
</html>