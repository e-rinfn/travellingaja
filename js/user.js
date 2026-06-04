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
  
});
