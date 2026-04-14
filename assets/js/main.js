// Tahun otomatis
document.getElementById("year").textContent = new Date().getFullYear();

// Mobile menu sederhana
const toggle = document.querySelector(".nav-toggle");
const navLinks = document.querySelector(".nav-links");

toggle?.addEventListener("click", () => {
  const opened = toggle.getAttribute("aria-expanded") === "true";
  toggle.setAttribute("aria-expanded", String(!opened));

  // Toggle tampil/hidden
  if (!opened) {
    navLinks.style.display = "flex";
    navLinks.style.position = "absolute";
    navLinks.style.top = "70px";
    navLinks.style.right = "28px";
    navLinks.style.flexDirection = "column";
    navLinks.style.gap = "10px";
    navLinks.style.padding = "12px";
    navLinks.style.border = "1px solid rgba(255,255,255,.14)";
    navLinks.style.borderRadius = "18px";
    navLinks.style.background = "rgba(0,0,0,.40)";
    navLinks.style.backdropFilter = "blur(10px)";
  } else {
    navLinks.removeAttribute("style");
  }
});

// Jika video gagal load, fallback ke gambar
const video = document.querySelector(".hero-video");
video?.addEventListener("error", () => {
  document.querySelector(".hero-video").style.display = "none";
  document.querySelector(".hero-image").style.display = "block";
});
const heroImgs = ["assets/bg1.jpg", "assets/bg2.jpg", "assets/bg3.jpg"];
let i = 0;

setInterval(() => {
  i = (i + 1) % heroImgs.length;
  const img = document.getElementById("heroImage");
  img.style.opacity = 0;
  setTimeout(() => {
    img.src = heroImgs[i];
    img.style.opacity = 1;
  }, 350);
}, 6000);