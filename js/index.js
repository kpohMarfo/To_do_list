let bars = document.querySelector(".bars");
let navMenu = document.querySelector(".nav-menu");

bars.addEventListener("click", (e) => {
  e.preventDefault();

  navMenu.classList.toggle("active");
  bars.classList.toggle("active");
});