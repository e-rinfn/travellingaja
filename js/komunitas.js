// ====== DATA (contoh awal) ======
  const seedVideos = [
    {
      id: crypto.randomUUID(),
      creator: "arifsihabudin_",
      location: "Ulsan, Korea",
      title: "Jalan sore di Ulsan • City vibe + sunset",
      platform: "YouTube",
      link: "https://www.youtube.com/",
      desc: "Video singkat suasana Ulsan. Cocok buat kamu yang suka city walk. Tips: datang 1 jam sebelum sunset biar dapat golden hour.",
      tags: ["citywalk","sunset","korea"]
    },
    {
      id: crypto.randomUUID(),
      creator: "traveller.id",
      location: "Bali, Indonesia",
      title: "Hidden cafe view sawah • budget tips",
      platform: "Instagram",
      link: "https://www.instagram.com/",
      desc: "Rekomendasi cafe hidden dengan view sawah. Budget makan 50–100rb. Jangan lupa datang pagi biar nggak rame.",
      tags: ["kuliner","cafe","bali","budget"]
    },
    {
      id: crypto.randomUUID(),
      creator: "nomad.daily",
      location: "Tokyo, Jepang",
      title: "1 hari di Tokyo: subway, ramen, night walk",
      platform: "TikTok",
      link: "https://www.tiktok.com/",
      desc: "Itinerary 1 hari keliling Tokyo, dari subway sampai ramen. Bawa IC card biar praktis.",
      tags: ["tokyo","japan","itinerary","ramen"]
    }
  ];

  // ====== localStorage (biar bisa simpan submit) ======
  const KEY = "jelajahi_videos_v1";
  function loadVideos(){
    const raw = localStorage.getItem(KEY);
    if(!raw){
      localStorage.setItem(KEY, JSON.stringify(seedVideos));
      return [...seedVideos];
    }
    try { return JSON.parse(raw) || []; }
    catch { return [...seedVideos]; }
  }
  function saveVideos(list){
    localStorage.setItem(KEY, JSON.stringify(list));
  }

  let videos = loadVideos();
  let activeCategory = "Semua";
  let q = "";

  // ====== kategori otomatis dari tag + platform ======
  function buildCategories(list){
    const s = new Set(["Semua"]);
    list.forEach(v => {
      s.add(v.platform);
      (v.tags||[]).forEach(t => s.add("#"+t));
    });
    return Array.from(s);
  }

  // ====== render chips ======
  const chipsEl = document.getElementById("chips");
  function renderChips(){
    const cats = buildCategories(videos);
    chipsEl.innerHTML = "";
    cats.forEach(cat=>{
      const el = document.createElement("div");
      el.className = "chip" + (cat===activeCategory ? " active" : "");
      el.textContent = cat;
      el.onclick = ()=>{ activeCategory = cat; renderChips(); renderFeed(); };
      chipsEl.appendChild(el);
    });
  }

  // ====== helper: aman buka link ======
  function safeOpen(url){
    const u = (url||"").trim();
    if(!u) return alert("Link kosong.");
    // Izinkan http/https saja
    if(!/^https?:\/\//i.test(u)) return alert("Link harus diawali http:// atau https://");
    window.open(u, "_blank", "noopener,noreferrer");
  }

  // ====== Filter ======
  function matchesCategory(v){
    if(activeCategory==="Semua") return true;
    if(activeCategory===v.platform) return true;
    if(activeCategory.startsWith("#")){
      const tag = activeCategory.slice(1);
      return (v.tags||[]).map(x=>x.toLowerCase()).includes(tag.toLowerCase());
    }
    return true;
  }
  function matchesQuery(v){
    if(!q) return true;
    const hay = [
      v.creator, v.location, v.title, v.platform, v.desc, ...(v.tags||[])
    ].join(" ").toLowerCase();
    return hay.includes(q.toLowerCase());
  }

  // ====== render feed ======
  const feedEl = document.getElementById("feed");

  function platformBadge(p){
    if(p==="YouTube") return "🎬 YouTube";
    if(p==="Instagram") return "📸 Instagram";
    if(p==="TikTok") return "🎵 TikTok";
    if(p==="Facebook") return "👥 Facebook";
    return "🔗 Link";
  }

  function embedHTML(link){
    // Simple preview: kalau YouTube, coba embed.
    // Jika bukan, tampilkan placeholder video (agar tetap rapi).
    try{
      const url = new URL(link);
      const host = url.hostname.replace("www.","");
      if(host.includes("youtube.com") || host.includes("youtu.be")){
        let vid = url.searchParams.get("v");
        if(!vid && host.includes("youtu.be")) vid = url.pathname.slice(1);
        if(vid){
          return `<iframe class="video" src="https://www.youtube.com/embed/${vid}" title="video" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        }
      }
    }catch(e){}
    return `<div class="video" style="display:flex;align-items:center;justify-content:center;color:#9fb0d0;">
              Preview hanya embed YouTube • Klik "Buka Link"
            </div>`;
  }

  function renderFeed(){
    const filtered = videos
      .filter(matchesCategory)
      .filter(matchesQuery)
      .slice().reverse();

    feedEl.innerHTML = "";

    if(filtered.length===0){
      feedEl.innerHTML = `
        <div class="card">
          <div class="card-body">
            <h3 class="title">Tidak ada hasil</h3>
            <p class="desc">Coba ganti kata kunci atau pilih kategori lain.</p>
          </div>
        </div>
      `;
      return;
    }

    filtered.forEach(v=>{
      const card = document.createElement("div");
      card.className = "card";
      card.innerHTML = `
        <div class="card-head">
          <div class="creator">
            <div class="avatar"></div>
            <div class="meta">
              <div class="name">@${escapeHtml(v.creator)}</div>
              <div class="sub">${escapeHtml(v.location)}</div>
            </div>
          </div>
          <div class="badge">${platformBadge(v.platform)}</div>
        </div>

        ${embedHTML(v.link)}

        <div class="card-body">
          <h3 class="title">${escapeHtml(v.title)}</h3>
          <p class="desc">${escapeHtml(shorten(v.desc, 130))}</p>

          <div class="row">
            <div class="tags">
              ${(v.tags||[]).slice(0,5).map(t=>`<span class="tag">#${escapeHtml(t)}</span>`).join("")}
            </div>

            <div class="card-actions">
              <button class="iconbtn" data-open="${v.id}">🔗 Buka Link</button>
              <button class="iconbtn" data-detail="${v.id}">📄 Detail</button>
              <span class="muted">Tersimpan lokal</span>
            </div>
          </div>
        </div>
      `;
      feedEl.appendChild(card);
    });

    // bind actions
    feedEl.querySelectorAll("[data-open]").forEach(btn=>{
      btn.addEventListener("click", ()=>{
        const id = btn.getAttribute("data-open");
        const v = videos.find(x=>x.id===id);
        if(v) safeOpen(v.link);
      });
    });
    feedEl.querySelectorAll("[data-detail]").forEach(btn=>{
      btn.addEventListener("click", ()=>{
        const id = btn.getAttribute("data-detail");
        const v = videos.find(x=>x.id===id);
        if(v) openDetail(v);
      });
    });
  }

  function shorten(text, n){
    if(!text) return "";
    return text.length>n ? text.slice(0,n-1)+"…" : text;
  }
  function escapeHtml(s){
    return String(s||"").replace(/[&<>"']/g, m => ({
      "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"
    }[m]));
  }

  // ====== Detail Modal ======
  const detailBackdrop = document.getElementById("detailBackdrop");
  const detailBody = document.getElementById("detailBody");
  const closeDetail = document.getElementById("closeDetail");

  function openDetail(v){
    document.getElementById("detailTitle").textContent = v.title;
    detailBody.innerHTML = `
      <div style="display:grid; gap:12px;">
        ${embedHTML(v.link)}
        <div>
          <div class="muted">Creator</div>
          <div style="font-weight:1000; font-size:16px;">@${escapeHtml(v.creator)}</div>
        </div>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
          <div>
            <div class="muted">Lokasi</div>
            <div style="font-weight:900;">${escapeHtml(v.location)}</div>
          </div>
          <div>
            <div class="muted">Platform</div>
            <div style="font-weight:900;">${escapeHtml(v.platform)}</div>
          </div>
        </div>
        <div>
          <div class="muted">Deskripsi</div>
          <div style="line-height:1.6; color:#dbe6ff;">${escapeHtml(v.desc)}</div>
        </div>
        <div>
          <div class="muted">Link Video</div>
          <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <code style="padding:8px 10px; border:1px solid var(--line); border-radius:12px; background:rgba(255,255,255,.06); overflow:auto; max-width:100%">${escapeHtml(v.link)}</code>
            <button class="btn primary" onclick="(${safeOpen.toString()})('${v.link.replace(/'/g,"\\'")}')">Buka</button>
          </div>
        </div>
        <div class="tags">
          ${(v.tags||[]).map(t=>`<span class="tag">#${escapeHtml(t)}</span>`).join("")}
        </div>
      </div>
    `;
    detailBackdrop.classList.add("show");
  }
  function closeDetailModal(){
    detailBackdrop.classList.remove("show");
  }
  closeDetail.onclick = closeDetailModal;
  detailBackdrop.addEventListener("click", (e)=>{
    if(e.target===detailBackdrop) closeDetailModal();
  });

  // ====== Submit Modal ======
  const submitBackdrop = document.getElementById("submitBackdrop");
  const openSubmit = document.getElementById("openSubmit");
  const closeSubmit = document.getElementById("closeSubmit");
  openSubmit.onclick = ()=> submitBackdrop.classList.add("show");
  closeSubmit.onclick = ()=> submitBackdrop.classList.remove("show");
  submitBackdrop.addEventListener("click", (e)=>{
    if(e.target===submitBackdrop) submitBackdrop.classList.remove("show");
  });

  // Submit form -> simpan ke localStorage
  const form = document.getElementById("submitForm");
  form.addEventListener("submit", (e)=>{
    e.preventDefault();
    const v = {
      id: crypto.randomUUID(),
      creator: document.getElementById("fCreator").value.trim(),
      location: document.getElementById("fLocation").value.trim(),
      title: document.getElementById("fTitle").value.trim(),
      platform: document.getElementById("fPlatform").value,
      link: document.getElementById("fLink").value.trim(),
      desc: document.getElementById("fDesc").value.trim(),
      tags: document.getElementById("fTags").value
              .split(",").map(x=>x.trim()).filter(Boolean)
    };

    if(!/^https?:\/\//i.test(v.link)){
      alert("Link harus diawali http:// atau https://");
      return;
    }

    videos.push(v);
    saveVideos(videos);
    renderChips();
    renderFeed();
    submitBackdrop.classList.remove("show");
    form.reset();
    alert("Berhasil! Video ditambahkan ke feed (tersimpan di browser).");
  });

  // tombol isi contoh
  document.getElementById("demoFill").onclick = ()=>{
    document.getElementById("fCreator").value = "arifsihabudin_";
    document.getElementById("fLocation").value = "Busan, Korea";
    document.getElementById("fTitle").value = "Vlog sehari di Busan: pantai + street food";
    document.getElementById("fPlatform").value = "YouTube";
    document.getElementById("fLink").value = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
    document.getElementById("fDesc").value = "Explore Busan dari pagi sampai malam. Ada tips transport, tempat makan murah, dan spot foto yang bagus.";
    document.getElementById("fTags").value = "busan,korea,vlog,kuliner,pantai";
  };

  // Search
  document.getElementById("searchInput").addEventListener("input", (e)=>{
    q = e.target.value.trim();
    renderFeed();
  });

  // init
  renderChips();
  renderFeed();