const translations = {
  id: {
    explore: "Jelajahi",
    about: "Tentang"
  },
  en: {
    explore: "Explore",
    about: "About"
  }
}

function toggleLanguage(){
  const menu = document.getElementById("languageDropdown");
  menu.classList.toggle("show");
}

window.onclick = function(e){
  if(!e.target.closest('.language-box')){
    const dropdown = document.getElementById("languageDropdown");
    dropdown.classList.remove("show");
  }
}

function setLang(lang){

  localStorage.setItem("lang", lang)

  // ganti teks
  document.querySelectorAll("[data-key]").forEach(el=>{
    const key = el.getAttribute("data-key")

    if(translations[lang] && translations[lang][key]){
      el.innerText = translations[lang][key]
    }
  })

  // update tombol
  const langMap = {
    id: '<span class="fi fi-id"></span> Indonesia',
    en: '<span class="fi fi-gb"></span> English',
    ko: '<span class="fi fi-kr"></span> 한국어',
    de: '<span class="fi fi-de"></span> Deutsch',
    ru: '<span class="fi fi-ru"></span> Русский',
    es: '<span class="fi fi-es"></span> Español',
    ar: '<span class="fi fi-sa"></span> العربية'
  }

  document.getElementById("langBtn").innerHTML = langMap[lang]

  // tutup dropdown
  document.getElementById("languageDropdown").classList.remove("show")
}

// auto load
document.addEventListener("DOMContentLoaded", function(){
  const savedLang = localStorage.getItem("lang") || "id"
  setLang(savedLang)
})
function toggleLanguage() {
  const dropdown = document.getElementById("languageDropdown");
  dropdown.classList.toggle("show");
}

window.addEventListener("click", function(e) {
  const button = document.getElementById("langBtn");
  const dropdown = document.getElementById("languageDropdown");

  if (!button.contains(e.target) && !dropdown.contains(e.target)) {
    dropdown.classList.remove("show");
  }
});