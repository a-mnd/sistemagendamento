/* Esse bloco de código foi realizado por conta de haver um pequeno bug de envio toda vez que houvesse uma inserção no input para filtrar pelo nome do funcionario 
Para resolver issom criei um delay no oniput (evento que dispara toda vez que há uma modificação no valor do input), para que o usuário possa escrever o nome e ele será ativado sómente depois de 500ms*/

/* Criamos uma variável timeout que terá um valor contendo nada */
let timeout = null;

/* Puxamos a função criado no input (delaydSubmit)*/
/* Toda vez que ocorrer um oniout event ele irá reproduzir essa função */
function delayedSubmit() {
    /* Toda vez que p usuário escreve no input o tempo será zerado */
    clearTimeout(timeout);
    
    /* Caso o usuário pare de digitar por um tempo especifico (neste caso é 0,5 segundos) ele ira submeter o input */
    timeout = setTimeout(() => {
        document.getElementById('form-filtros').submit();
    }, 500); // Tempo em milissegundos (0,5 segundos)
}

/* Então, estamos setando um determinado tempo de envio com o método setTimeout, porém ele não será acionado enquando o usuário não para de escrever no input, por conta que o setTimeout será reiniciado pelo clearTimeout */

/* ---------------------------------------- */
/* Parte de nível de acesso */
/* ---------------------------------------- */

document.querySelectorAll('.checkbox').forEach((checkbox) => {
    checkbox.addEventListener('change', function () {
        const idFuncionario = this.getAttribute('data-funcionario');
        const idNivel = this.getAttribute('data-nivel');
        const isChecked = this.checked ? 1 : 0;

        fetch('../admin/atualizar_acesso.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_funcionario: idFuncionario,
                id_acesso: idNivel,
                acesso_ativo: isChecked
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarModal('Acesso atualizado com sucesso!');
            } else {
                mostrarModal(data.message || 'Erro ao atualizar acesso');
            }
        })
        .catch(error => {
            mostrarModal('Acesso atualizado com sucesso!');
        });
    });
});

function mostrarModal(mensagem) {
    const modal = document.querySelector('.modalAlert');
    const p = modal.querySelector('p');
    p.textContent = mensagem; // Atualiza o conteúdo do parágrafo no modal
    
    // Mostra o modal com a animação de entrada
    modal.classList.add('show');
    
    // Depois de 3 segundos, faz o modal desaparecer
    setTimeout(() => {
        modal.classList.add('hide');
    }, 3000); // O modal sai após 3 segundos
    
    // Remove a classe hide após a animação, permitindo que o modal possa ser reaparecido
    setTimeout(() => {
        location.reload();
        modal.classList.remove('show');
        modal.classList.remove('hide');

    }, 3500); // Remove a animação de saída após o tempo
}