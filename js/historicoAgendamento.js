// Função para abrir o modal
function abrirModal() {
    document.getElementById('modal').style.display = 'block';
}

// Função para fechar o modal
function fecharModal() {
    document.getElementById('modal').style.display = 'none';
}

// Função para confirmar o cancelamento
function confirmarCancelamento() {
    // Esconder a mensagem de confirmação
    document.getElementById('confirmacaoCancelamento').style.display = 'block';
    // Esconder a mensagem de confirmação inicial
    document.getElementById('confirmado').style.display = 'none';
    // Esconder os botões de sim e não
    document.querySelectorAll('#modal button').forEach(button => {
        button.style.display = 'none';
    });
    // Você pode adicionar aqui qualquer ação adicional relacionada ao cancelamento
}


// botao da configuração você clica aparece os links
const botao = document.getElementById('botao');
const li = document.getElementById('li');
botao.onclick = () => {
    li.classList.toggle('lista');
};

function abrirModalReagendar() {
    document.getElementById('modal-container-reagendar').style.display = 'block';
}

function fecharModal() {
    document.getElementById('modal-container-reagendar').style.display = 'none';
    document.getElementById('modal').style.display = 'none';
}

function fecharDialog() {
    document.getElementById('modal-container-fechado').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    function abrirModalDataFechada() {
        var dialog = document.getElementById('modal-container-fechado');
        if (!dialog.open) {
            dialog.style.display = 'block';
        }
    }

    document.getElementById('data').addEventListener('change', function() {
        // Verifica se a data selecionada é segunda-feira ou domingo
        var dataSelecionada = new Date(document.getElementById('data').value);
        var diaSelecionado = dataSelecionada.getDay();
        if (diaSelecionado == 0 || diaSelecionado == 1) { // 0 = domingo, 1 = segunda-feira
            // Mostra o modal informando que a data está fechada
            abrirModalDataFechada(); // Chama a função corretamente
        }
    });
});