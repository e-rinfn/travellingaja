<?php
require_once "config.php";

$q   = isset($_GET["q"]) ? trim($_GET["q"]) : "";
$cat = isset($_GET["cat"]) ? trim($_GET["cat"]) : "Semua";

/* ambil data approved + search + filter */
$sql = "SELECT * FROM videos WHERE status='approved'";
$params = [];
$types = "";

if ($q !== "") {
  $sql .= " AND (creator LIKE ? OR location LIKE ? OR title LIKE ? OR platform LIKE ? OR description LIKE ? OR tags LIKE ?)";
  $like = "%".$q."%";
  $params = array_merge($params, [$like,$like,$like,$like,$like,$like]);
  $types .= "ssssss";
}

if ($cat !== "" && $cat !== "Semua") {
  // cat bisa platform (YouTube) atau tag (#kuliner)
  if (strpos($cat, "#") === 0) {
    $tag = substr($cat, 1);
    $sql .= " AND tags LIKE ?";
    $params[] = "%".$tag."%";
    $types .= "s";
  } else {
    $sql .= " AND platform = ?";
    $params[] = $cat;
    $types .= "s";
  }
}

$sql .= " ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
if (!empty($params)) $stmt->bind_param($types, ...$params);
$stmt->execute();
$res = $stmt->get_result();
$videos = $res->fetch_all(MYSQLI_ASSOC);

function e($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }

/* bikin list kategori dari platform + tag yang ada */
$cats = ["Semua","YouTube","Instagram","TikTok","Facebook","Link Lain"];
foreach($videos as $v){
  $tags = array_filter(array_map("trim", explode(",", $v["tags"] ?? "")));
  foreach($tags as $t){
    $h = "#".$t;
    if ($t !== "" && !in_array($h, $cats)) $cats[] = $h;
  }
}

/* youtube embed */
function yt_embed($url){
  $url = trim($url);
  if ($url === "") return "";

  $url = preg_replace('/\s+/', '', $url);

  $u = parse_url($url);
  if(!$u || !isset($u["host"])) return "";

  $host = strtolower(str_replace("www.","", $u["host"]));
  $path = $u["path"] ?? "";
  $query = $u["query"] ?? "";

  // youtube watch
  if (strpos($host, "youtube.com") !== false) {

    // support shorts
    if (preg_match('~^/shorts/([^/?]+)~', $path, $m)) {
      return "https://www.youtube.com/embed/".$m[1];
    }

    parse_str($query, $q);
    if (!empty($q["v"])) {
      return "https://www.youtube.com/embed/".$q["v"];
    }
  }

  // youtu.be link
  if (strpos($host, "youtu.be") !== false) {
    $id = trim($path, "/");
    if ($id) return "https://www.youtube.com/embed/".$id;
  }

  return "";
}
?>
<?php
if (!function_exists("yt_id")) {
  function yt_id($url){
    $u = parse_url(trim($url));
    if(!$u || !isset($u["host"])) return "";
    $host = strtolower(str_replace("www.","",$u["host"]));
    $path = $u["path"] ?? "";
    $query = $u["query"] ?? "";

    if (strpos($host,"youtube.com") !== false) {
      // support shorts
      if (preg_match('~^/shorts/([^/?]+)~', $path, $m)) return $m[1];
      parse_str($query, $q);
      return $q["v"] ?? "";
    }
    if (strpos($host,"youtu.be") !== false) {
      return trim($path, "/");
    }
    return "";
  }
}

if (!function_exists("yt_thumb")) {
  function yt_thumb($id){
    if(!$id) return "";
    return "https://i.ytimg.com/vi/".$id."/hqdefault.jpg";
  }
}
?>
<?php
// ===== Helpers =====

// Deteksi platform dari link
function detect_platform($url){
  $u = strtolower(trim($url ?? ''));
  if ($u === '') return 'none';

  if (strpos($u, 'youtube.com') !== false || strpos($u, 'youtu.be') !== false) return 'youtube';
  if (strpos($u, 'instagram.com') !== false) return 'instagram';
  if (strpos($u, 'tiktok.com') !== false) return 'tiktok';
  if (strpos($u, 'facebook.com') !== false || strpos($u, 'fb.watch') !== false) return 'facebook';

  return 'link';
}

// Ambil YouTube ID (support youtu.be, watch?v=, shorts/)
function youtube_id($url){
  $url = trim($url ?? '');
  if ($url === '') return '';

  $parts = parse_url($url);
  if (!$parts || empty($parts['host'])) return '';

  $host = strtolower(str_replace('www.', '', $parts['host']));
  $path = $parts['path'] ?? '';
  $query = $parts['query'] ?? '';

  // youtu.be/ID
  if ($host === 'youtu.be') {
    $id = trim($path, '/');
    return $id;
  }

  // youtube.com/watch?v=ID
  if (strpos($host, 'youtube.com') !== false) {
    // shorts
    if (preg_match('~^/shorts/([^/?]+)~', $path, $m)) return $m[1];

    parse_str($query, $q);
    if (!empty($q['v'])) return $q['v'];
  }

  return '';
}

function youtube_embed_url($id){
  $id = trim($id ?? '');
  if ($id === '') return '';
  return "https://www.youtube.com/embed/{$id}?rel=0&modestbranding=1";
}

function youtube_thumb_url($id){
  $id = trim($id ?? '');
  if ($id === '') return '';
  // hqdefault biasanya aman
  return "https://i.ytimg.com/vi/{$id}/hqdefault.jpg";
}

// Instagram: bikin link embed resmi (tapi video tetap biasanya tidak “play clean”)
// kita pakai preview + tombol
function instagram_permalink($url){
  $u = trim($url ?? '');
  if ($u === '') return '';
  // normalisasi: buang query string
  $parts = parse_url($u);
  if (!$parts) return $u;
  $scheme = $parts['scheme'] ?? 'https';
  $host   = $parts['host'] ?? 'www.instagram.com';
  $path   = $parts['path'] ?? '';
  return $scheme.'://'.$host.$path;
}

// TikTok embed URL (pakai /embed/)
function tiktok_embed_url($url){
  $u = trim($url ?? '');
  if ($u === '') return '';

  // Ambil video id dari .../video/123456...
  if (preg_match('~/video/(\d+)~', $u, $m)) {
    $id = $m[1];
    return "https://www.tiktok.com/embed/v2/{$id}";
  }
  return '';
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jelajahi • TravellingAja</title>
  <link rel="stylesheet" href="assets/premium.css">
</head>
<body>
  <!-- background hidup -->
  <div class="bg-wrap"></div>
  <div class="bg-noise"></div>
  <div class="orb one"></div>
  <div class="orb two"></div>
  <div class="orb three"></div>

  <!-- topbar -->
  <div class="topbar">
    <div class="inner">
      <div class="brand">
        <div class="logo"></div>
        <div>Jelajahi <small>Platform Video Traveller</small></div>
      </div>

      <form class="search" method="GET" action="jelajahi.php">
        🔎
        <input name="q" value="<?=e($q)?>" placeholder="Cari… Busan, Tokyo, pantai, kuliner">
        <input type="hidden" name="cat" value="<?=e($cat)?>">
      </form>

      <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn" href="index.html">Beranda</a>
        <a class="btn primary" href="submit.php">+ Submit</a>
      </div>
    </div>
  </div>

  <div class="wrap">
    <div class="grid">

      <!-- Sidebar kategori -->
      <aside class="card sidebar">
        <div style="font-weight:1000;margin-bottom:10px;">Kategori</div>
        <div class="chips">
          <?php foreach($cats as $c): ?>
            <a class="chip <?=($c===$cat?'active':'')?>"
              href="jelajahi.php?cat=<?=urlencode($c)?>&q=<?=urlencode($q)?>">
              <?=e($c)?>
            </a>
          <?php endforeach; ?>
        </div>

        <p class="hint" style="margin-top:12px;">
          Video yang tampil hanya yang sudah <b>approved</b> oleh admin.
        </p>
      </aside>

      <!-- Feed -->
      <main class="feed">
        <?php if(count($videos)===0): ?>
          <div class="card">
            <div class="card-body">
              <div class="title">Belum ada video yang cocok</div>
              <div class="hint">Coba ubah kata kunci atau kategori.</div>
            </div>
          </div>
        <?php endif; ?>

        <?php foreach($videos as $v): ?>
          <?php
            $embed = yt_embed($v["link"]);
            $tags = array_filter(array_map("trim", explode(",", $v["tags"] ?? "")));
          ?>
          <div class="card">
  <div class="card-head">
    <div class="creator">
      <div class="avatar"></div>
      <div>
        <div class="name">@<?= e($v["creator"]) ?></div>
        <div class="sub"><?= e($v["location"]) ?> • <?= e($v["created_at"]) ?></div>
      </div>
    </div>
    <div class="badge"><?= e($v["platform"]) ?></div>
  </div>

<?php
$link = $v['link'] ?? '';

$platform = detect_platform($link);

$ytId = youtube_id($link);
$ytEmbed = $ytId ? youtube_embed_url($ytId) : '';

$igPermalink = instagram_permalink($link);
$ttEmbed = tiktok_embed_url($link);
?>

<div class="video">

<?php if ($platform === 'youtube' && $ytEmbed): ?>

<iframe
width="100%"
height="315"
src="<?= e($ytEmbed) ?>"
frameborder="0"
allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
allowfullscreen>
</iframe>

<?php elseif ($platform === 'instagram'): ?>

<div class="ig-preview">
📷 Video Instagram tidak bisa diputar langsung<br>
<a class="btn primary" href="<?= e($igPermalink) ?>" target="_blank">
Buka Instagram
</a>
</div>

<?php elseif ($platform === 'tiktok' && $ttEmbed): ?>

<iframe
width="100%"
height="315"
src="<?= e($ttEmbed) ?>"
frameborder="0"
allowfullscreen>
</iframe>

<?php else: ?>

<div class="link-preview">
<a class="btn primary" href="<?= e($link) ?>" target="_blank">
Buka Video
</a>
</div>

<?php endif; ?>

</div>

  <div class="card-body">
    <p class="title"><?= e($v["title"]) ?></p>
    <p class="desc"><?= e($v["description"]) ?></p>

    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:10px;">
      <?php foreach(array_slice($tags,0,6) as $t): ?>
        <a class="chip" href="jelajahi.php?cat=<?= urlencode('#'.$t) ?>&q=<?= urlencode($q) ?>">#<?= e($t) ?></a>
      <?php endforeach; ?>
    </div>

    <a class="btn primary" href="<?= e($v["link"]) ?>" target="_blank" rel="noopener noreferrer">▶ Buka Video</a>
  </div>
</div>
<?php endforeach; ?>

</main>
</div> <!-- grid -->
</div> <!-- wrap -->

</body>
</html>