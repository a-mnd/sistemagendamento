<?php
include_once "../admin/conexao.php";
$id_servico = $_GET['id_servico'] ?? '';

$selectServ = $conexao->prepare("SELECT nome_servico, valor, descricao_servico FROM servicos WHERE id_servico = :id_servico");
$selectServ->execute(['id_servico' => $id_servico]);

while($array = $selectServ->fetch(PDO::FETCH_ASSOC)) {
    $nome_servico = $array['nome_servico'];
    $descricao = $array['descricao_servico'];
    $valor = $array['valor'];
}
?>
<div id="modalAlterar" style="z-index:1000;">
    <div class="divFlex">
        <form id="alteracaoForm" method="post" action="../admin/atualizar_servico.php">
            <input type="hidden" name="id_servico" id="id_servico" value="<?= $id_servico ?>">
            <div class="data">
                <h1 class="escolhas"> Alteração de serviço</h1>
            </div>
            <div class="container-inputs">
                <div class="grupo-input">
                    <label for="nome_servico">Nome do Serviço</label>
                    <input type="text" class="name" name="nome_servico" value="<?= $nome_servico ?>">
                </div>
                <div class="grupo-input">
                    <label for="desc_servico">Descrição do Serviço</label>
                    <textarea type="text" class="name" name="desc_servico" value="<?= $descricao ?>"></textarea>
                </div>
                <div class="grupo-input">
                    <label for="valor">Valor</label>
                    <input type="text" class="name" name="valor_servico" value="<?= $valor ?>">
                </div>
            </div>
            <button type="submit" class="confirmar alterar">Alterar</button>
            <!-- <button type="button" class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button> -->
        </form>
    </div>
</div>
<script>
    document.querySelector('.confirmar').addEventListener('click', function() {
        const id_servico = document.getElementById('id_servico').value;
        window.location.href = '../admin/atualizar_servico.php?id_servico=' + id_servico;
    });

    // document.querySelector('.fechar').addEventListener('click', function() {
    //     window.location.href = 'listaServicos.php';
    // });
</script>