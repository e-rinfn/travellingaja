<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jelajahi - TravellingAja</title>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jelajahi - TravellingAja</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/netflix-travel.css">
  <link rel="stylesheet" href="css/jelajahi.css">
  <link rel="stylesheet" href="css/khususjelajahi.css">
</head>
<body>
  <body class="jelajahi-page">

  <div class="page-overlay"></div>

  <!-- HEADER -->
 <header class="jelajahi-header">

<div class="logo">
  <img src="assets/logo.png" alt="logo" class="logo-img">
  <span class="logo-text">Travelling<span>Aja</span></span>
</div>

<div class="nav-search">
  <span class="search-icon">🔍</span>
  <input type="text" placeholder="Cari destinasi, negara, atau cerita..." />
</div>

<nav class="nav-menu">
  <a href="index.php">Beranda</a>
  <a href="#">Jelajahi</a>
  <a href="#">Trending</a>
  <a href="#">Destinations</a>
  <a href="#">Favorites</a>
  <a href="#">Stories</a>

  <?php if(isset($_SESSION['nama'])): ?>
    <div class="user-box">
      👤 <?php echo $_SESSION['nama']; ?>
      <a href="logout.php">Logout</a>
    </div>
  <?php else: ?>
    <a href="login.php" class="login-btn">Login</a>
  <?php endif; ?>
</nav>

</header>

  <!-- HERO -->
  <section class="hero-jelajahi">
    <div class="hero-content">
      <p class="hero-badge">Curated Travel Discovery Platform</p>
      <h1>Jelajahi Dunia <br> Lewat TravellingAja</h1>
      <p class="hero-desc">
        Temukan video travelling pilihan dari berbagai belahan dunia.
        Semua konten dikurasi oleh TravellingAja agar nyaman ditonton,
        mudah dicari, dan tetap estetik dalam satu platform.
      </p>

      <div class="hero-search-box">
        <input type="text" id="searchInput" placeholder="Cari destinasi... contoh: Korea, Bali, Busan, Paris">
        <button id="searchBtn">Cari</button>
      </div>

      <div class="hero-tags">
        <span onclick="filterVideos('all')">Semua</span>
        <span onclick="filterVideos('asia')">Asia</span>
        <span onclick="filterVideos('europe')">Eropa</span>
        <span onclick="filterVideos('beach')">Pantai</span>
        <span onclick="filterVideos('city')">Kota</span>
        <span onclick="filterVideos('nature')">Alam</span>
        <span onclick="filterVideos('korea')">Korea</span>
        <span onclick="filterVideos('indonesia')">Indonesia</span>
      </div>
    </div>
  </section>

  <!-- COUNTRY FILTER -->
  <section class="country-filter-section">
    <div class="section-title-wrap">
      <p class="mini-title">Search by Country</p>
      <h2>Pilih Negara Favoritmu</h2>
    </div>

    <div class="country-filter-wrap">
      <button onclick="filterVideos('all')">All</button>
      <button onclick="filterVideos('korea')">Korea</button>
      <button onclick="filterVideos('indonesia')">Indonesia</button>
      <button onclick="filterVideos('france')">France</button>
      <button onclick="filterVideos('switzerland')">Switzerland</button>
      <button onclick="filterVideos('maldives')">Maldives</button>
      <button onclick="filterVideos('japan')">Japan</button>
    </div>
  </section>

  <!-- TRENDING -->
  <section class="trending-section" id="trending">
    <div class="section-title-wrap">
      <p class="mini-title">Trending Now</p>
      <h2>Destinasi yang Lagi Banyak Dilirik</h2>
    </div>

    <div class="trending-grid">
      <div class="trending-card">
        <span class="trending-rank">#1</span>
        <h3>Busan, Korea</h3>
        <p>Pantai, city vibe, dan spot malam yang estetik.</p>
      </div>

      <div class="trending-card">
        <span class="trending-rank">#2</span>
        <h3>Bali, Indonesia</h3>
        <p>Nuansa tropis, sunset, dan tempat healing favorit.</p>
      </div>

      <div class="trending-card">
        <span class="trending-rank">#3</span>
        <h3>Paris, France</h3>
        <p>Klasik, elegan, dan romantis dalam satu perjalanan.</p>
      </div>

      <div class="trending-card">
        <span class="trending-rank">#4</span>
        <h3>Seoul, Korea</h3>
        <p>Modern, hidup, dan penuh destinasi urban menarik.</p>
      </div>
    </div>
  </section>

  <!-- FEATURED -->
  <section class="featured-video-section">
    <div class="section-title-wrap">
      <p class="mini-title">Featured Journey</p>
      <h2>Perjalanan Pilihan Minggu Ini</h2>
    </div>

    <div class="featured-video-card">
      <div class="featured-video-frame">
        <iframe
          src="https://www.youtube.com/embed/r9PeYPHdpNo"
          title="Featured Travel Video"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>

      <div class="featured-info">
        <p class="featured-location">📍Papua Barat Daya, Indonesia</p>
        <h3>Raja Ampat</h3>
        <p>
         <p>
Jelajahi keindahan Raja Ampat, surga tropis di Papua Barat Daya
yang terkenal dengan laut biru jernih, pulau-pulau karst yang
eksotis, dan salah satu ekosistem laut terkaya di dunia.
</p>
        </p>

        <div class="interaction-bar">
          <button class="like-btn" onclick="toggleLike(this)">🤍 Like <span>245</span></button>
          <button class="comment-btn">💬 32 Komentar</button>
          <button class="save-btn" onclick="saveFeatured()">⭐ Save</button>
        </div>
      </div>
    </div>
  </section>

  <!-- DESTINATIONS -->
  <section class="video-section" id="destinations">
    <div class="section-title-wrap">
      <p class="mini-title">Popular Destinations</p>
      <h2>Explore Destinations</h2>
    </div>

    <div class="video-grid" id="videoGrid">

      <div class="video-card" data-category="asia city korea busan">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/Scxs7L0vhZ4"
            title="Busan Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Busan, Korea</h3>
          <p>Kota pesisir yang modern, indah, dan penuh spot menarik.</p>
          <div class="card-meta">
            <span>📍 Asia</span>
            <span>🏙 City</span>
            <span>🇰🇷 Korea</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>124</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/Scxs7L0vhZ4', 'Busan, Korea')">▶ Watch</button>
            <button onclick="saveFavorite('Busan, Korea')">⭐ Save</button>
          </div>
        </div>
      </div>

      <div class="video-card" data-category="asia beach bali indonesia">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/JxzZXdht-XY"
            title="Bali Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Bali, Indonesia</h3>
          <p>Pantai, budaya, sunset, dan suasana tropis yang menenangkan.</p>
          <div class="card-meta">
            <span>📍 Asia</span>
            <span>🏝 Beach</span>
            <span>🇮🇩 Indonesia</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>312</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/JxzZXdht-XY', 'Bali, Indonesia')">▶ Watch</button>
            <button onclick="saveFavorite('Bali, Indonesia')">⭐ Save</button>
          </div>
        </div>
      </div>

      <div class="video-card" data-category="europe city paris france">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/REDVbTQxMXo"
            title="Paris Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Paris, France</h3>
          <p>Kota romantis dengan arsitektur elegan dan suasana klasik.</p>
          <div class="card-meta">
            <span>📍 Europe</span>
            <span>🏙 City</span>
            <span>🇫🇷 France</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>189</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/REDVbTQxMXo', 'Paris, France')">▶ Watch</button>
            <button onclick="saveFavorite('Paris, France')">⭐ Save</button>
          </div>
        </div>
      </div>

      <div class="video-card" data-category="nature mountain switzerland europe">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/linlz7-Pnvw"
            title="Switzerland Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Switzerland</h3>
          <p>Pegunungan, danau, dan pemandangan alam yang memukau.</p>
          <div class="card-meta">
            <span>📍 Europe</span>
            <span>🌿 Nature</span>
            <span>🇨🇭 Switzerland</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>276</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/linlz7-Pnvw', 'Switzerland')">▶ Watch</button>
            <button onclick="saveFavorite('Switzerland')">⭐ Save</button>
          </div>
        </div>
      </div>

      <div class="video-card" data-category="asia korea seoul city">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/T7s8SmJxReA"
            title="Seoul Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Seoul, Korea</h3>
          <p>Perpaduan budaya modern, kuliner, dan tempat wisata populer.</p>
          <div class="card-meta">
            <span>📍 Asia</span>
            <span>🏙 City</span>
            <span>🇰🇷 Korea</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>352</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/T7s8SmJxReA', 'Seoul, Korea')">▶ Watch</button>
            <button onclick="saveFavorite('Seoul, Korea')">⭐ Save</button>
          </div>
        </div>
      </div>

      <div class="video-card" data-category="beach nature maldives">
        <div class="video-frame">
          <iframe
            src="https://www.youtube.com/embed/0I647GU3Jsc"
            title="Maldives Travel"
            frameborder="0"
            allowfullscreen>
          </iframe>
        </div>
        <div class="video-info">
          <h3>Maldives</h3>
          <p>Laut biru jernih, resort indah, dan vibes liburan mewah.</p>
          <div class="card-meta">
            <span>🏝 Beach</span>
            <span>🌿 Nature</span>
            <span>🇲🇻 Maldives</span>
          </div>
          <div class="card-actions">
            <button onclick="toggleLike(this)">🤍 <span>421</span></button>
            <button onclick="openVideoModal('https://www.youtube.com/embed/0I647GU3Jsc', 'Maldives')">▶ Watch</button>
            <button onclick="saveFavorite('Maldives')">⭐ Save</button>
          </div>
        </div>
      </div>

    </div>
  </section>
<!-- TRAVEL FEED -->
<section class="travel-feed">

  <div class="section-title-wrap">
    <p class="mini-title">Global Travel Feed</p>
    <h2>Explore the World</h2>
  </div>

  <div class="feed-grid" id="feedGrid">

    <div class="feed-card">
      <video muted loop preload="metadata" poster="https://i.ytimg.com/vi/Scxs7L0vhZ4/hqdefault.jpg">
        <source src="https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
      </video>
      <div class="feed-info">
        <h3>Busan Coastal Walk</h3>
        <p>South Korea</p>
      </div>
    </div>

    <div class="feed-card">
      <video muted loop preload="metadata" poster="https://i.ytimg.com/vi/JxzZXdht-XY/hqdefault.jpg">
        <source src="https://storage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4" type="video/mp4">
      </video>
      <div class="feed-info">
        <h3>Bali Sunset View</h3>
        <p>Indonesia</p>
      </div>
    </div>

  </div>
</section>

<!-- WORLD MAP -->
<section class="world-map-section">

  <div class="section-title-wrap">
    <p class="mini-title">Global Travel Explorer</p>
    <h2>Pilih Negara di Peta</h2>
  </div>

  <div class="map-container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg" class="world-map" alt="World Map">

    <div class="map-points">
      <button class="map-point korea" onclick="showCountry('korea')">🇰🇷</button>
      <button class="map-point indonesia" onclick="showCountry('indonesia')">🇮🇩</button>
      <button class="map-point france" onclick="showCountry('france')">🇫🇷</button>
      <button class="map-point switzerland" onclick="showCountry('switzerland')">🇨🇭</button>
    </div>
  </div>

  <div id="countryVideos" class="country-video-box"></div>

</section>
  <!-- FAVORITES -->
  <section class="favorites-section" id="favorites">
    <div class="section-title-wrap">
      <p class="mini-title">Saved For Later</p>
      <h2>Favorite Destinations</h2>
    </div>

    <div class="favorite-box">
      <p class="favorite-note">Destinasi yang kamu simpan akan muncul di sini.</p>
      <ul id="favoriteList"></ul>
    </div>
  </section>

  <!-- STORIES -->
  <section class="stories-section" id="stories">
    <div class="section-title-wrap">
      <p class="mini-title">Curated Stories</p>
      <h2>Travel Stories</h2>
    </div>

    <div class="stories-grid">
      <div class="story-box">
        <h3>Hidden Gems</h3>
        <p>Tempat-tempat indah yang belum terlalu ramai, tapi sangat layak dikunjungi.</p>
      </div>
      <div class="story-box">
        <h3>City Escapes</h3>
        <p>Rekomendasi perjalanan singkat ke kota-kota menarik dengan vibes modern.</p>
      </div>
      <div class="story-box">
        <h3>Nature Retreats</h3>
        <p>Konten perjalanan alam untuk kamu yang suka suasana tenang dan healing.</p>
      </div>
    </div>
  </section>

  <!-- COMMENTS -->
  <section class="comments-section">
    <div class="section-title-wrap">
      <p class="mini-title">Community Reactions</p>
      <h2>Komentar Pengunjung</h2>
    </div>

    <div class="comment-form">
      <input type="text" id="nameInput" placeholder="Nama kamu">
      <textarea id="commentInput" placeholder="Tulis komentar tentang destinasi ini..."></textarea>
      <button onclick="addComment()">Kirim Komentar</button>
    </div>

    <div class="comment-list" id="commentList">
      <div class="comment-item">
        <strong>Nadia</strong>
        <p>Website travel seperti ini enak banget, terasa lebih rapi dan fokus.</p>
      </div>
      <div class="comment-item">
        <strong>Rizal</strong>
        <p>Suka konsepnya, bisa nonton travel video langsung tanpa pindah-pindah.</p>
      </div>
    </div>
  </section>

  <!-- VIDEO MODAL -->
  <div class="video-modal" id="videoModal">
    <div class="video-modal-content">
      <button class="close-modal" onclick="closeVideoModal()">✕</button>
      <h3 id="modalTitle">Travel Video</h3>
      <div class="modal-video-frame">
        <iframe
          id="modalIframe"
          src=""
          title="Travel Modal Video"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="jelajahi-footer">
    <p>© 2026 TravellingAja. Curated travel inspiration for every traveller.</p>
  </footer>

  <script src="js/jelajahi.js"></script>
</body>
</html>