const notifica = document.getElementById('notifica');
const input = document.getElementById('cep');

input.addEventListener('input', buscaCEP);

function buscaCEP() {
    const cep = document.getElementById('cep').value;
    let url = `https://viacep.com.br/ws/${cep}/json/`;

    if (cep.length == 8) {
        fetch(url)
        .then(resposta => resposta.json())
        .then(dados => {
            if(dados.erro) {
                notifica.innerHTML = "<p>CEP Inválido</p>";
                notifica.open = true
                return
            }
            notifica.innerHTML = "<p>CEP Encontrado!</p>";
            notifica.open = true;
            setTimeout(()=>{notifica.open = false}, 2000);

            document.getElementById('endereco').value = dados.logradouro
            document.getElementById('bairro').value = dados.bairro
            document.getElementById('cidade').value = dados.localidade
            document.getElementById('uf').value = dados.uf
        });
    } else {
        notifica.innerHTML = "<p>Digite 8 números válido</p>"
        notifica.open = true;
    }
};

function limparDados() {
    let cep = document.getElementById('cep').value;
    if (cep == '') {
        document.getElementById('endereco').value = ''
        document.getElementById('bairro').value = ''
        document.getElementById('cidade').value = ''
        document.getElementById('uf').value = ''
    }
}