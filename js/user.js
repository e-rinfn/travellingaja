function toggleUserMenu() {
  const menu = document.getElementById("userMenu");
  menu.classList.toggle("active");
}

// klik luar = close
document.addEventListener("click", function(e) {
  const menu = document.getElementById("userMenu");
  const user = document.querySelector(".user-name");

  if (!user.contains(e.target)) {
    menu.classList.remove("active");
  }
  function setLang(lang){

localStorage.setItem("lang", lang)

// update teks
document.querySelectorAll("[data-key]").forEach(el=>{
const key=el.getAttribute("data-key")

if(translations[lang][key]){
el.innerText=translations[lang][key]
}
})

// 🔥 update tombol language
const langMap = {
  id: "🇮🇩 Indonesia",
  en: "🇬🇧 English",
  de: "🇩🇪 Deutsch",
  ru: "🇷🇺 Русский",
  es: "🇪🇸 Español",
  ar: "🇸🇦 العربية"
}

document.getElementById("langBtn").innerText = langMap[lang]

}
});
