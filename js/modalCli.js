const form_cadastro = document.getElementById("loginForm");
const avisos = document.getElementById("avisos"); // O dialog

form_cadastro.addEventListener("submit", (e) => { 
    e.preventDefault(); 
    let dados_form = new FormData(form_cadastro);

    fetch("../emails/validaremail.php", {
        body: dados_form,
        method: "POST",
    })
    .then((resposta) => {
        if (!resposta.ok) {
            throw new Error(`Erro HTTP: ${resposta.status}`);
        }
        return resposta.json();
    })
    .then((response) => {
        // Verifica o status
        if (response.status === 'success') {
            avisos.innerHTML = response.message + '<i class="fa-solid fa-spinner fa-spin"></i>';
            avisos.open = true;
            setTimeout(() => {
                avisos.open = false;
                // Redireciona para outra página após fechar o modal
                window.location.href = "http://localhost/sistemaagendamento/public/homecliente.php";
            }, 3000);
        } else {
            avisos.innerHTML = response.message;
            avisos.open = true;
            setTimeout(() => {
                avisos.open = false;
            }, 3000);
        }
    })
    .catch((erro) => {
        console.error("Erro:", erro); // Detalhe do erro
        avisos.innerHTML = "Erro inesperado: " + erro.message;
        avisos.open = true;
        setTimeout(() => {
            avisos.open = false;
        }, 3000);
    });
});