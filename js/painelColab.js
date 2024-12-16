const statusSituacao = document.querySelectorAll('.situacaoCard');
statusSituacao.forEach((situacao) => {
    situacao.innerHTML == "Inativo" ? situacao.style.backgroundColor = "#8000007b" : situacao.style.backgroundColor = "#0080007b"
})
const btnsEditar = document.querySelectorAll('.btn-editar');
const modal = document.getElementById('modal-colaborador');

/* Campos do modal */
const inputIdFuncionario = document.getElementById('id_funcionario');
const inputNome = document.getElementById('nome');
const inputContato = document.getElementById('contato');
const inputSituacao = document.getElementById('situ');
const inputCargo = document.getElementById('cargo');
const inputEmail = document.getElementById('email');
const inputCep = document.getElementById('cep');
const inputEndereco = document.getElementById('endereco');
const inputComplemento = document.getElementById('comp');
const inputBairro = document.getElementById('bairro');
const inputCidade = document.getElementById('cidade');
const inputUF = document.getElementById('uf');
/* IMG funcionario */
const fotoFunc = document.getElementById('img_funcionario');


btnsEditar.forEach((btn) => {
    btn.addEventListener('click', function () {
        let fotoFuncionarioModal = document.getElementById('foto_funcionario').value;

        console.log(fotoFuncionarioModal + 'oi');

        /* Pegando dados do atributo data */
        const id_func = this.getAttribute('data-id');
        const nome = this.getAttribute('data-nome');
        const contato = this.getAttribute('data-contato');
        const situacao = this.getAttribute('data-situacao');
        const cargo = this.getAttribute('data-cargo');
        const email = this.getAttribute('data-email');
        const cep = this.getAttribute('data-cep');
        const endereco = this.getAttribute('data-endereco');
        const complemento = this.getAttribute('data-complemento');
        const bairro = this.getAttribute('data-bairro');
        const cidade = this.getAttribute('data-cidade');
        const uf = this.getAttribute('data-uf');
        const img = this.getAttribute('data-img');

        /* Passando dados do atributo data ao valor dos inputs */
        inputIdFuncionario.value = id_func;
        inputNome.value = nome;
        inputContato.value = contato;
        inputSituacao.value = situacao;
        inputCargo.value = cargo;
        inputEmail.value = email;
        inputCep.value = cep;
        inputEndereco.value = endereco;
        inputComplemento.value = complemento;
        inputBairro.value = bairro;
        inputCidade.value = cidade;
        inputUF.value = uf;
        fotoFunc.src = 'data:image/jpeg;base64,'+img;

        modal.showModal();
        document.body.style.overflowY = "hidden";
    });
});

const fecharModal = document.getElementById('fechar');
fecharModal.addEventListener('click', function () {
    modal.close();
    document.body.style.overflowY = "auto";
});
const cancelarFormulario = document.getElementById('cancelar');
cancelarFormulario.addEventListener('click', function() {
    modal.close();
    document.body.style.overflowY = "auto";
})

/* Esse código faz com que a imagem selecionada no input file seja mostrada como preview na imagem do funcionário no modal */
document.getElementById('foto_funcionario').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const imgFuncionario = document.getElementById('img_funcionario');
    imgFuncionario.src = URL.createObjectURL(file);
});