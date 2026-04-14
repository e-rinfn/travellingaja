<?php
require_once "config.php";

// TOKEN ADMIN (biar orang lain gak bisa masuk)
$ADMIN_TOKEN = "ARIF_ADMIN_2026";  // boleh kamu ganti jadi yang kamu mau

$token = $_GET["token"] ?? "";
if ($token !== $ADMIN_TOKEN) {
  http_response_code(403);
  die("403 Forbidden - token salah. Pakai: admin.php?token=ARIF_ADMIN_2026");
}

// aksi approve / reject
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = intval($_POST["id"] ?? 0);
  $action = $_POST["action"] ?? "";

  if ($id > 0 && ($action === "approve" || $action === "reject")) {
    $status = ($action === "approve") ? "approved" : "rejected";
    $stmt = $conn->prepare("UPDATE videos SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
  }
  header("Location: admin.php?token=" . urlencode($ADMIN_TOKEN));
  exit;
}

// ambil video pending
$pending = $conn->query("SELECT * FROM videos WHERE status='pending' ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

function e($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Review • Jelajahi</title>
  <style>
    body{font-family:Arial,sans-serif;background:#0b0f17;color:#eaf0ff;margin:0;padding:20px}
    .box{max-width:980px;margin:0 auto}
    .card{background:#111b2e;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:14px;margin-bottom:12px}
    .top{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap}
    a.btn,button.btn{display:inline-block;padding:9px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.06);color:#eaf0ff;font-weight:bold;cursor:pointer;text-decoration:none}
    button.primary{background:linear-gradient(135deg, rgba(120,180,255,.95), rgba(0,255,210,.65));border:none;color:#081018}
    .muted{color:#a9b7d6;font-size:12px}
    code{background:rgba(255,255,255,.06);padding:6px 8px;border-radius:10px;border:1px solid rgba(255,255,255,.10)}
    .row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-top:10px}
    h2{margin:0}
  </style>
</head>
<body>
  <div class="box">
    <div class="card top">
      <div>
        <h2>Admin Review (Pending)</h2>
        <div class="muted">Approve = tampil di Jelajahi • Reject = ditolak</div>
      </div>
      <div class="row" style="margin:0">
        <a class="btn" href="submit.php">Submit Page</a>
        <a class="btn" href="jelajahi.php">Lihat Feed</a>
      </div>
    </div>

    <?php if(count($pending)===0): ?>
      <div class="card">
        <b>Tidak ada pending.</b>
        <div class="muted">Semua video sudah direview.</div>
      </div>
    <?php endif; ?>

    <?php foreach($pending as $v): ?>
      <div class="card">
        <b>#<?=intval($v["id"])?> • <?=e($v["title"])?></b>
        <div class="muted">@<?=e($v["creator"])?> • <?=e($v["location"])?> • <?=e($v["platform"])?> • <?=e($v["created_at"])?></div>
        <p style="margin-top:10px;line-height:1.5;color:#dbe6ff"><?=e($v["description"])?></p>

        <div class="muted">Link: <code><?=e($v["link"])?></code></div>

        <div class="row">
          <a class="btn" href="<?=e($v["link"])?>" target="_blank" rel="noopener noreferrer">Preview Link</a>

          <form method="POST" style="display:inline">
            <input type="hidden" name="id" value="<?=intval($v["id"])?>">
            <button class="btn primary" name="action" value="approve" type="submit">✅ Approve</button>
          </form>

          <form method="POST" style="display:inline">
            <input type="hidden" name="id" value="<?=intval($v["id"])?>">
            <button class="btn" name="action" value="reject" type="submit">❌ Reject</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</body>
</html>