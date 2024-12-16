<?php
include_once "../admin/conexao.php";
$id_agendamento = $_GET['id_agendamento'] ?? '';
$cancelaSQL = $conexao->prepare("DELETE FROM agendamento WHERE id_agendamento= :id_agendamento");
?>
<div id="modalCancel">
    <div class="divFlex">
        <form id="CancelaForm" method="post" action="delete_agendamento.php">
            <h1 class="certeza">Você tem certeza?</h1>
            <input type="hidden" name="id_agendamento" id="id_agendamento" value="<?= $id_agendamento ?>">
            <div class="grupo-input">
                <div class="naocancela"><a href="historico.php">Não</div>
                <button type="submit" class="confirmar">Sim</button>
            </div>
        </form>
    </div>
</div>
<script>
    // document.querySelector('.confirmar').addEventListener('click', function() {
    //     const id_agendamento = document.getElementById('id_agendamento').value;
    //     window.location.href = '../admin/delete_agendamento.php?id_agendamento=' + id_agendamento;
    // });

    document.querySelector('.naocancela').addEventListener('click', function() {
        const modal = document.getElementById('modalCancel');
        modal.style.display = 'none';
        //window.location.href = 'NewhistoricoAgend.php';
    });
</script>