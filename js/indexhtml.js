const images = [
  "assets/assets/bg1.jpg",
  "assets/assets/bg2.jpg",
  "assets/assets/bg3.jpg"
];

let index = 0;

const img1 = document.getElementById("img1");
const img2 = document.getElementById("img2");

let isFirst = true;

setInterval(() => {
  index = (index + 1) % images.length;

  if (isFirst) {
    img2.src = images[index];
    img2.classList.add("active");
    img1.classList.remove("active");
  } else {
    img1.src = images[index];
    img1.classList.add("active");
    img2.classList.remove("active");
  }

  isFirst = !isFirst;

}, 4000);