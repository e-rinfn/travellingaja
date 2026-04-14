<?php
require_once "config.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $creator = trim($_POST["creator"] ?? "");
  $location = trim($_POST["location"] ?? "");
  $title = trim($_POST["title"] ?? "");
  $platform = trim($_POST["platform"] ?? "");
  $link = trim($_POST["link"] ?? "");
  $desc = trim($_POST["description"] ?? "");
  $tags = trim($_POST["tags"] ?? "");

  if ($creator==="" || $location==="" || $title==="" || $platform==="" || $link==="" || $desc==="") {
    $msg = "❌ Lengkapi semua data yang wajib (*)";
  } elseif (!preg_match('/^https?:\/\//i', $link)) {
    $msg = "❌ Link harus diawali http:// atau https://";
  } else {
    $stmt = $conn->prepare("INSERT INTO videos (creator,location,title,platform,link,description,tags,status) VALUES (?,?,?,?,?,?,?,'pending')");
    $stmt->bind_param("sssssss", $creator,$location,$title,$platform,$link,$desc,$tags);
    $stmt->execute();
    $msg = "✅ Berhasil! Video masuk antrean <b>Pending</b> (menunggu verifikasi admin).";
  }
}

function e($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Submit Video • Jelajahi</title>
  <style>
    body{font-family:Arial,sans-serif;background:#0b0f17;color:#eaf0ff;margin:0;padding:20px}
    .box{max-width:720px;margin:0 auto;background:#111b2e;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:18px}
    input,select,textarea{width:100%;padding:10px;margin-top:6px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.06);color:#eaf0ff}
    textarea{min-height:90px}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    @media(max-width:720px){.row{grid-template-columns:1fr}}
    .btn{display:inline-block;padding:10px 14px;border-radius:999px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.06);color:#eaf0ff;font-weight:bold;cursor:pointer;text-decoration:none}
    .btn.primary{background:linear-gradient(135deg, rgba(120,180,255,.95), rgba(0,255,210,.65));border:none;color:#081018}
    .msg{margin-top:12px;padding:12px;border-radius:12px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10)}
    small{color:#a9b7d6}
  </style>
</head>
<body>
  <div class="box">
    <h2>Submit Video Traveller</h2>
    <small>Video tidak langsung tampil. Admin akan review dulu (Pending → Approved).</small>

    <?php if($msg): ?>
      <div class="msg"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" style="margin-top:12px">
      <div class="row">
        <div>
          <label>Nama Creator *</label>
          <input name="creator" required placeholder="contoh: arifsihabudin_">
        </div>
        <div>
          <label>Lokasi *</label>
          <input name="location" required placeholder="contoh: Busan, Korea">
        </div>
      </div>

      <div style="margin-top:10px">
        <label>Judul Video *</label>
        <input name="title" required placeholder="contoh: Seharian di Busan (pantai + kuliner)">
      </div>

      <div class="row" style="margin-top:10px">
        <div>
          <label>Platform *</label>
          <select name="platform" required>
            <option>YouTube</option>
            <option>Instagram</option>
            <option>TikTok</option>
            <option>Facebook</option>
            <option>Link Lain</option>
          </select>
        </div>
        <div>
          <label>Link Video *</label>
          <input name="link" required placeholder="https://...">
        </div>
      </div>

      <div style="margin-top:10px">
        <label>Deskripsi *</label>
        <textarea name="description" required placeholder="Ceritakan perjalanan, tips, budget, jam terbaik..."></textarea>
      </div>

      <div style="margin-top:10px">
        <label>Tag (pisahkan koma)</label>
        <input name="tags" placeholder="pantai, kuliner, budget, solo">
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn primary" type="submit">Submit</button>
        <a class="btn" href="jelajahi.php">Lihat Feed</a>
      </div>
    </form>
  </div>
</body>
</html>