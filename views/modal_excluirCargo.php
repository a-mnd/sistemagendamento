<?php
include_once "../admin/conexao.php";
$id_cargo = $_GET['id_cargo'] ?? '';
$excluirSQL = $conexao->prepare("DELETE FROM cargo WHERE id_cargo = :id_cargo");

?>
<div id="modalExcluir"> <!--style="z-index:1000;"-->
    <div class="divFlex">
        <form id="ExcluiForm" method="post" action="../admin/delete_cargo.php">
            <h1 class="certeza">Você tem certeza?</h1>
            <input type="hidden" name="id_cargo" id="id_cargo" value="<?= $id_cargo ?>">
            <div class="grupo-input">
                <div class="naocancela"><a href="listaCargos.php">Não</a></div>
                <button type="submit" class="confirmar" id="confirmar">Sim</button>
            </div>
        </form>
    </div>
</div>
<script>
    // document.getElementById('confirmar').addEventListener('click', function() {
    //     const id_cargo = document.getElementById('id_cargo').value;
    //     console.log(id_cargo);
    //     window.location.href = '../admin/delete_cargo.php?id_cargo=' + id_cargo;
    // });
    // document.querySelector('.naocancela').addEventListener('click', function() {
    //     window.location.href = 'listaCargos.php';
    // });
</script>