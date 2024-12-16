
// const usuario = document.getElementById('usuario');
// const botao = document.createElement("button");
// botao.innerText = "OK";

// usuario.addEventListener("click", () => {
//     usuario.innerHTML = "Sair?";
//     usuario.appendChild(botao);
// });

// botao.addEventListener("click", () => {
//     window.location.href = "/index.html";
// });

const usuario = document.getElementById('usuario');
const originalContent = usuario.innerHTML; // Armazena o conteúdo HTML original

usuario.addEventListener("click", (event) => {
    usuario.innerHTML = "Sair?";
    
    const botao = document.createElement("button"); // Cria o botão dentro do listener
    botao.innerText = "OK";
    
    usuario.appendChild(botao);

    // Impede a propagação do evento de clique para o documento
    event.stopPropagation();

    botao.addEventListener("click", () => {
        window.location.href = "/index.html";
    });
});

// Adiciona um listener para cliques no documento
document.addEventListener("click", (event) => {
    // Verifica se o clique foi fora do elemento 'usuario'
    if (!usuario.contains(event.target)) {
        usuario.innerHTML = originalContent; // Restaura o conteúdo original
    }
});


// botao da configuração você clica aparece os links
const botao = document.getElementById('botao');
const li = document.getElementById('li');
botao.onclick = () => {
    li.classList.toggle('lista');
};