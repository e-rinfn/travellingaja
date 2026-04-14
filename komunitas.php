<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Jelajahi • TravellingAja</title>
  <style>
    :root{
      --bg:#0b0f17;
      --panel:#0f1624;
      --card:#111b2e;
      --text:#eaf0ff;
      --muted:#9fb0d0;
      --line:rgba(255,255,255,.08);
      --chip:rgba(255,255,255,.06);
      --shadow: 0 10px 30px rgba(0,0,0,.35);
      --radius:18px;
    }
    *{box-sizing:border-box}
    body{
      margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background: radial-gradient(1200px 700px at 10% 0%, rgba(80,110,255,.20), transparent 60%),
                  radial-gradient(900px 600px at 80% 10%, rgba(0,220,255,.12), transparent 55%),
                  var(--bg);
      color:var(--text);
    }
    a{color:inherit; text-decoration:none}
    .wrap{max-width:1100px; margin:0 auto; padding:18px}
    /* Top bar */
    .topbar{
      position:sticky; top:0; z-index:50;
      background: rgba(11,15,23,.75);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--line);
    }
    .topbar .inner{
      max-width:1100px; margin:0 auto; padding:14px 18px;
      display:flex; gap:12px; align-items:center; justify-content:space-between;
    }
    .brand{
      display:flex; gap:10px; align-items:center;
      font-weight:700; letter-spacing:.3px;
    }
    .logo{
      width:38px; height:38px; border-radius:12px;
      background: linear-gradient(135deg, rgba(120,180,255,.9), rgba(0,255,210,.7));
      box-shadow: var(--shadow);
    }
    .brand small{display:block; color:var(--muted); font-weight:600; margin-top:2px}
    .search{
      flex:1; max-width:520px;
      display:flex; gap:10px; align-items:center;
      background: rgba(255,255,255,.06);
      border: 1px solid var(--line);
      border-radius: 999px;
      padding:10px 14px;
    }
    .search input{
      width:100%; border:none; outline:none;
      background:transparent; color:var(--text);
      font-size:14px;
    }
    .actions{display:flex; gap:10px; align-items:center}
    .btn{
      border:1px solid var(--line);
      background: rgba(255,255,255,.06);
      color:var(--text);
      padding:10px 14px;
      border-radius:999px;
      cursor:pointer;
      font-weight:700;
    }
    .btn.primary{
      background: linear-gradient(135deg, rgba(120,180,255,.95), rgba(0,255,210,.65));
      border:none;
      color:#081018;
    }
    /* Layout */
    .grid{
      display:grid;
      grid-template-columns: 260px 1fr;
      gap:18px;
      margin-top:18px;
    }
    @media (max-width: 920px){
      .grid{grid-template-columns:1fr}
      .sidebar{position:relative; top:auto}
    }
    .sidebar{
      position:sticky; top:86px;
      align-self:start;
      background: rgba(255,255,255,.04);
      border:1px solid var(--line);
      border-radius: var(--radius);
      padding:14px;
    }
    .side-title{font-weight:800; margin:2px 0 10px}
    .chips{display:flex; flex-wrap:wrap; gap:8px}
    .chip{
      padding:8px 10px; border-radius:999px;
      border:1px solid var(--line);
      background: var(--chip);
      color:var(--text);
      cursor:pointer;
      font-weight:700;
      font-size:12px;
      user-select:none;
    }
    .chip.active{
      background: rgba(120,180,255,.22);
      border-color: rgba(120,180,255,.45);
    }
    .hint{
      margin-top:12px;
      color:var(--muted);
      font-size:12px;
      line-height:1.5;
    }
    /* Feed cards */
    .feed{display:grid; gap:14px}
    .card{
      background: rgba(255,255,255,.04);
      border:1px solid var(--line);
      border-radius: var(--radius);
      overflow:hidden;
      box-shadow: var(--shadow);
    }
    .card-head{
      display:flex; gap:10px; align-items:center; justify-content:space-between;
      padding:12px 14px; border-bottom:1px solid var(--line);
    }
    .creator{display:flex; gap:10px; align-items:center}
    .avatar{
      width:38px; height:38px; border-radius:999px;
      background: linear-gradient(135deg, rgba(255,255,255,.22), rgba(255,255,255,.05));
      border:1px solid var(--line);
    }
    .creator .meta{line-height:1.2}
    .creator .name{font-weight:900}
    .creator .sub{color:var(--muted); font-size:12px; font-weight:700}
    .badge{
      font-size:12px; font-weight:900;
      padding:6px 10px; border-radius:999px;
      background: rgba(0,255,210,.12);
      border:1px solid rgba(0,255,210,.22);
      color:#bfffea;
      white-space:nowrap;
    }
    .video{
      width:100%;
      aspect-ratio: 16/9;
      background:#000;
      display:block;
    }
    .card-body{padding:12px 14px}
    .title{font-weight:900; font-size:16px; margin:0 0 6px}
    .desc{color:var(--muted); margin:0 0 10px; line-height:1.45}
    .row{display:flex; flex-wrap:wrap; gap:10px; align-items:center; justify-content:space-between}
    .tags{display:flex; flex-wrap:wrap; gap:8px}
    .tag{
      font-size:12px; font-weight:800;
      padding:7px 10px; border-radius:999px;
      background: rgba(255,255,255,.06);
      border:1px solid var(--line);
      color: var(--text);
    }
    .card-actions{display:flex; gap:10px; flex-wrap:wrap}
    .iconbtn{
      display:inline-flex; gap:8px; align-items:center;
      padding:9px 12px; border-radius:999px;
      border:1px solid var(--line);
      background: rgba(255,255,255,.06);
      cursor:pointer;
      font-weight:900;
      font-size:13px;
    }
    .iconbtn:hover{transform: translateY(-1px)}
    .muted{color:var(--muted); font-weight:800; font-size:12px}
    /* Modal */
    .backdrop{
      position:fixed; inset:0; background: rgba(0,0,0,.55);
      display:none; align-items:center; justify-content:center;
      padding:18px; z-index:100;
    }
    .backdrop.show{display:flex}
    .modal{
      width:min(760px, 100%);
      background: rgba(15,22,36,.92);
      border:1px solid var(--line);
      border-radius: 22px;
      overflow:hidden;
      box-shadow: 0 24px 60px rgba(0,0,0,.55);
      backdrop-filter: blur(12px);
    }
    .modal-head{
      display:flex; align-items:center; justify-content:space-between;
      padding:12px 14px; border-bottom:1px solid var(--line);
    }
    .modal-title{font-weight:1000}
    .close{cursor:pointer; font-weight:1000; opacity:.85}
    .modal-body{padding:14px}
    .form{
      display:grid; gap:10px;
      grid-template-columns: 1fr 1fr;
    }
    .form .full{grid-column:1/-1}
    label{font-size:12px; color:var(--muted); font-weight:900}
    input, textarea, select{
      width:100%;
      border:1px solid var(--line);
      background: rgba(255,255,255,.06);
      color:var(--text);
      border-radius:14px;
      padding:10px 12px;
      outline:none;
      font-size:14px;
    }
    textarea{min-height:90px; resize:vertical}
    .footer-note{margin-top:10px; color:var(--muted); font-size:12px; line-height:1.45}
  </style>
  <link rel="stylesheet" href="css/komunitas.css">
</head>

<body>
  <!-- Topbar -->
  <div class="topbar">
    <div class="inner">
      <div class="brand">
        <div class="logo"></div>
        <div>
          Komunitas
          <small>Platform Video Traveller</small>
        </div>
      </div>

      <div class="search" title="Cari judul, lokasi, creator, tag...">
        🔎
        <input id="searchInput" placeholder="Cari video… misal: Busan, Tokyo, pantai, kuliner" />
      </div>

      <div class="actions">
        <a class="btn" href="index.php">← Beranda</a>
        <button class="btn primary" id="openSubmit">+ Submit Video</button>
      </div>
    </div>
  </div>

  <div class="wrap">
    <div class="grid">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="side-title">Kategori</div>
        <div class="chips" id="chips"></div>

        <div class="hint">
          <b>Tip:</b> Klik kategori untuk filter.  
          Klik <b>Detail</b> buat lihat deskripsi lengkap & link video.  
          Kamu bisa tempel link YouTube / Instagram / TikTok / Google Drive (public).
        </div>
      </aside>

      <!-- Feed -->
      <main>
        <div class="feed" id="feed"></div>
        <div class="hint" style="margin-top:14px">
          © TravellingAja • Versi HTML (lokal). Kalau kamu mau ini jadi beneran platform (login, like, komentar, upload),
          kita lanjut bikin versi <b>PHP + MySQL</b>.
        </div>
      </main>
    </div>
  </div>

  <!-- Modal Detail -->
  <div class="backdrop" id="detailBackdrop" aria-hidden="true">
    <div class="modal">
      <div class="modal-head">
        <div class="modal-title" id="detailTitle">Detail Video</div>
        <div class="close" id="closeDetail">✕</div>
      </div>
      <div class="modal-body" id="detailBody"></div>
    </div>
  </div>

  <!-- Modal Submit -->
  <div class="backdrop" id="submitBackdrop" aria-hidden="true">
    <div class="modal">
      <div class="modal-head">
        <div class="modal-title">Submit Video Traveller</div>
        <div class="close" id="closeSubmit">✕</div>
      </div>
      <div class="modal-body">
        <form id="submitForm" class="form">
          <div>
            <label>Nama Creator</label>
            <input id="fCreator" placeholder="contoh: arifsihabudin_" required />
          </div>
          <div>
            <label>Lokasi</label>
            <input id="fLocation" placeholder="contoh: Busan, Korea" required />
          </div>

          <div class="full">
            <label>Judul Video</label>
            <input id="fTitle" placeholder="contoh: Hidden Beach di Busan (sunset vibes)" required />
          </div>

          <div>
            <label>Platform</label>
            <select id="fPlatform">
              <option value="YouTube">YouTube</option>
              <option value="Instagram">Instagram</option>
              <option value="TikTok">TikTok</option>
              <option value="Facebook">Facebook</option>
              <option value="Link Lain">Link Lain</option>
            </select>
          </div>
          <div>
            <label>Link Video</label>
            <input id="fLink" placeholder="tempel URL video…" required />
          </div>

          <div class="full">
            <label>Deskripsi</label>
            <textarea id="fDesc" placeholder="Ceritain perjalanan, tips, budget, jam terbaik, dll…" required></textarea>
          </div>

          <div class="full">
            <label>Tag (pisahkan dengan koma)</label>
            <input id="fTags" placeholder="pantai, sunset, kuliner, solo travelling" />
          </div>

          <div class="full" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:6px;">
            <button type="submit" class="btn primary">Submit</button>
            <button type="button" class="btn" id="demoFill">Isi contoh</button>
          </div>

          <div class="footer-note full">
            <b>Catatan:</b> Versi HTML ini menyimpan data hanya di browser (localStorage).
            Kalau mau data tersimpan di server dan bisa dipakai banyak orang, kita buat versi <b>PHP + MySQL</b>.
          </div>
        </form>
      </div>
    </div>
  </div>
<script src="js/komunitas.js"></script>
</body>
</html>
</html>