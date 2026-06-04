<?php
session_start();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beranda — Travelling Aja</title>

  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="shortcut icon" href="favicon.png">
  <link rel="apple-touch-icon" href="favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">

  <link rel="stylesheet" href="css/navbar-extra.css">
  <link rel="stylesheet" href="css/logo.css">
  <link rel="stylesheet" href="css/user.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Background media -->
  <div class="hero-media" aria-hidden="true">
    <img class="hero-image active" id="img1" src="assets/assets/bg1.jpg" alt="Background travel 1">
    <img class="hero-image" id="img2" src="assets/assets/bg2.jpg" alt="Background travel 2">

    <div class="hero-overlay"></div>
    <div class="hero-grain"></div>
  </div>

  <!-- Navbar -->
  <header class="nav">
    <a class="brand" href="index.php">
      <img src="assets/logo.png" alt="Travelling Aja Logo" class="brand-logo">
      <span class="brand-name">Travelling Aja</span>
    </a>

    <nav class="nav-links">
      <a href="jelajahi.php">Jelajahi</a>
      <a href="#komunitas">Komunitas</a>
      <a href="#kulineran">Kulineran</a>
      <a href="#tentang">Tentang</a>
      <a class="pill" href="#contact">Bagikan Perjalananmu di sini</a>

      <div class="language-box">
        <button class="language-button" type="button" onclick="toggleLanguage()" id="langBtn">
          🌐 Language
        </button>

        <div class="language-dropdown" id="languageDropdown">
          <a href="javascript:void(0)" onclick="setLang('id')"><span class="fi fi-id"></span> Indonesia</a>
          <a href="javascript:void(0)" onclick="setLang('en')"><span class="fi fi-gb"></span> English</a>
          <a href="javascript:void(0)" onclick="setLang('ko')"><span class="fi fi-kr"></span> 한국어</a>
          <a href="javascript:void(0)" onclick="setLang('de')"><span class="fi fi-de"></span> Deutsch</a>
          <a href="javascript:void(0)" onclick="setLang('ru')"><span class="fi fi-ru"></span> Русский</a>
          <a href="javascript:void(0)" onclick="setLang('es')"><span class="fi fi-es"></span> Español</a>
          <a href="javascript:void(0)" onclick="setLang('ar')"><span class="fi fi-sa"></span> العربية</a>
        </div>
      </div>

      <?php if (isset($_SESSION['nama'])): ?>
        <div class="user-dropdown-container">
          <div class="user-name" onclick="toggleUserMenu()">
            <i class="fa-solid fa-user"></i>
            <?php echo htmlspecialchars($_SESSION['nama']); ?>
          </div>

          <div class="user-dropdown" id="userMenu">
            <a href="#">👤 Profile</a>
            <a href="logout.php">🚪 Logout</a>
          </div>
        </div>
      <?php else: ?>
        <a class="nav-login" href="login.php">Login</a>
        <a class="nav-register" href="register.php">Daftar</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Hero -->
  <main class="hero">
    <section class="hero-content">
      <p class="kicker">Teman Wisata Anda</p>
      <h1 class="title">Travelling Aja</h1>

      <p class="sub">
        Pelan-pelan, kita tentukan ke mana langkahmu berikutnya — teman asik yang selalu jadi andalan wisatamu.
      </p>

      <div class="cta-row">
        <a class="btn primary" href="#journeys">Mulai Menjelajah</a>
        <a class="btn ghost" href="#contact">Bagikan Perjalanan Anda</a>
      </div>

      <div class="meta-row">
        <span class="dot"></span><span>Cerita perjalanan nyata</span>
        <span class="sep">•</span>
        <span>Inspirasi tanpa batas</span>
        <span class="sep">•</span>
        <span>Untuk semua traveller</span>
        <span class="sep">•</span>
        <span>Since 2026</span>
      </div>
    </section>

    <aside class="hero-side">
      <div class="glass card">
        <p class="small">About Me</p>
        <h3>Curriculum Vitae (CV)</h3>
        <p class="muted">Arif Sihabudin</p>
        <a class="link" href="folder arif sihabudin/portfolio.html">View Portfolio →</a>
      </div>

      <div class="glass card">
        <p class="small">Next departure</p>
        <h3>March 2026</h3>
        <p class="muted">Limited slots available.</p>
        <a class="link" href="#contact">Request invite →</a>
      </div>
    </aside>

    <div class="scroll-hint">
      <span>Scroll</span>
      <div class="mouse">
        <div class="wheel"></div>
      </div>
    </div>
  </main>

  <!-- Sections -->
  <section id="journeys" class="section">
    <div class="container">
      <h2><a href="jelajahi.php" class="section-link">Jelajahi</a></h2>
      <p>Coming soon.</p>
    </div>
  </section>

  <section id="komunitas" class="section">
    <div class="container">
      <h2><a href="komunitas.php" class="section-link">Komunitas</a></h2>
      <p>Coming soon.</p>
    </div>
  </section>

  <section id="kulineran" class="section">
    <div class="container">
      <h2>Kulineran</h2>
      <p>Coming soon.</p>
    </div>
  </section>

  <section id="tentang" class="section">
    <div class="container">
      <h2>Tentang</h2>
      <p>
        Website Travelling Aja hadir sebagai platform perjalanan modern yang dirancang untuk menghubungkan inspirasi, pengalaman, dan informasi wisata dalam satu ruang digital yang terintegrasi.
        Kami bertujuan memudahkan setiap orang dalam menemukan destinasi terbaik, merencanakan perjalanan dengan lebih percaya diri, serta menikmati pengalaman travelling yang lebih bermakna.
      </p>

      <p>
        Platform ini juga menjadi wadah bagi para konten kreator perjalanan dari berbagai pelosok untuk berbagi cerita, perspektif, dan pengalaman autentik mereka.
        Melalui konten yang lebih nyata dan terperinci, pengguna dapat memperoleh referensi wisata yang lebih relevan, terpercaya, dan inspiratif.
      </p>

      <p>
        Dengan fokus khusus pada dunia travel, Travelling Aja membantu wisatawan menjelajahi tempat baru dengan informasi yang lebih jelas, pengalaman yang lebih personal, serta rekomendasi yang lahir langsung dari perjalanan nyata.
        Kami percaya bahwa setiap perjalanan bukan sekadar tujuan, tetapi sebuah cerita yang layak untuk ditemukan dan dibagikan.
      </p>

      <div class="tentang-tagline">
        <span>Discover more.</span>
        <span>Travel smarter.</span>
        <span>Experience deeper. ^^</span>
      </div>
    </div>
  </section>

  <section id="contact" class="section">
    <div class="container">
      <h2>Contact (Bagikan perjalananmu di sini)</h2>

      <form class="form" action="https://formspree.io/f/xlgwnjor" method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="pesan" rows="4" placeholder="Kirim link video disertakan biodata pengirim..." required></textarea>

        <input type="hidden" name="_subject" value="Pesan baru dari Travelling Aja">

        <button class="btn primary" type="submit">Kirim</button>
      </form>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p class="footer-credit">
        © <span id="year"></span> Travelling Aja — Website design by:
        <a class="ig-link" href="https://instagram.com/arifsihabudin_" target="_blank" rel="noopener noreferrer">
          <i class="fa-brands fa-instagram"></i>
          arifsihabudin_
        </a>
      </p>
    </div>
  </footer>

  <script src="js/user.js"></script>
  <script src="js/indexhtml.js"></script>
  <script src="js/language.js"></script>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>