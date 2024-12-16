<?php
include_once "../admin/conexao.php";
$id_cargo = $_GET['id_cargo'] ?? '';

$selectCargo = $conexao->prepare("SELECT nome_cargo FROM cargo WHERE id_cargo = :id_cargo");
$selectCargo->execute(['id_cargo' => $id_cargo]);

while($array = $selectCargo->fetch(PDO::FETCH_ASSOC)) {
    $nome_cargo = $array['nome_cargo'];
}
?>
<div id="modalAlterar" style="z-index:1000;">
    <div class="divFlex">
        <form id="alteracaoForm" method="post" action="../admin/atualizar_cargo.php">
            <input type="hidden" name="id_cargo" id="id_cargo" value="<?= $id_cargo ?>">
            <div class="data">
                <h1 class="escolha"> Alteração de cargo</h1>
            </div>
            <div class="container-inputs">
                <div class="grupo-input">
                    <label for="nome_cargo">Nome do Cargo</label>
                    <input type="text" class="name" name="nome_cargo" value="<?= $nome_cargo ?>">
                </div>
            </div>
            <button type="submit" class="confirmar">Alterar</button>
            <!-- <button type="button" class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button> -->
        </form>
    </div>
</div>
<script>
    document.querySelector('.confirmar').addEventListener('click', function() {
        const id_cargo = document.getElementById('id_cargo').value;
        window.location.href = '../admin/atualizar_cargo.php?id_cargo=' + id_cargo;
    });

    document.querySelector('.fechar').addEventListener('click', function() {
        window.location.href = 'listaCargos.php';
    });
</script>