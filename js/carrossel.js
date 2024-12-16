const slides = document.querySelectorAll('.slides');
const ids = ['um', 'dois', 'tres']; //array com as ids
let slideIndex = 0; //indice das imagens

 
function passarFotos() {
    slides.forEach((slide, index) => {
       slide.id = ''; //tira temporariamente as ids
    });
    slideIndex++; //incrementa a posicao das imagens
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    slides.forEach((slide, index) => {
        slide.id = ids[(index + slideIndex) % slides.length]; // Adiciona ID de acordo com a posição
    });

    setTimeout(passarFotos, 3000); 
}
passarFotos();