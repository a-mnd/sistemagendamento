const form_recado = document.getElementById('form_recado');
const avisos = document.getElementById('avisos');

form_recado.addEventListener("submit", (e) => {
    e.preventDefault();
    let dados_formulario = new FormData(form_recado);
    fetch("../admin/processar_CadFuncionario.php", {
            body: dados_formulario,
            method: 'POST'
        })
        .then((resposta) => {
            if (resposta.ok) {
                return resposta.text();
            }
        })
        .then((mensagem) => {
            avisos.innerHTML = mensagem;
            avisos.open = true;
            console.log(dados_formulario)
            console.log(mensagem)
            setTimeout(() => {
                avisos.open = false;
            }, 3000);
        });
});