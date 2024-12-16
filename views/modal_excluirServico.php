<?php
include_once "../admin/conexao.php";
$id_servico = $_GET['id_servico'] ?? '';
$excluirSql = $conexao->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
//$excluirSql->execute(['id_servico' => $id_servico]);

?>
<div id="modalExcluir"> <!--style="z-index:1000;"-->
    <div class="divFlex">
        <form id="ExcluiForm" method="post" action="../admin/delete_servico.php">
            <h1 class="certeza">Você tem certeza?</h1>
            <input type="hidden" name="id_servico" id="id_servico" value="<?= $id_servico ?>">
            <div class="naocancela"><a href="listaServicos.php">Não</a></div>
            <button type="submit" class="confirmar">Sim</button>
        </form>
    </div>
</div>
<script>
    // document.querySelector('.confirmar').addEventListener('click', function() {
    //     const id_servico = document.getElementById('id_servico').value;
    //     window.location.href = '../admin/delete_servico.php?id_servico=' + id_servico;
    // });

    // document.querySelector('.naocancela').addEventListener('click', function() {
    //     window.location.href = 'listaServicos.php';
    // });
</script>