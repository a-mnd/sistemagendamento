const menuLateral = document.getElementById("menu-mobile");

document.getElementById("menu-hamburguer").addEventListener("click", function() {
    menuLateral.style.right = "0px"
});

document.getElementById("close-button").addEventListener("click", function() {
    menuLateral.style.right = "-286px"
})

