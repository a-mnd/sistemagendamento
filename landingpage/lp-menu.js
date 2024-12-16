const hamburguer = document.querySelector(".hamburguer");
const nav = document.querySelector("nav");
const bg_menu = document.getElementById("bg-menu");
const corpo = document.querySelector("html");

hamburguer.addEventListener("click", () => {
    nav.classList.toggle("active");
    corpo.classList.toggle("scrool");

    
    setTimeout(() => {
        bg_menu.classList.toggle("action");
    }, 500);
});