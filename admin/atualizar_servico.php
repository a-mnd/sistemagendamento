<?php
include_once "../admin/conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_servico = $_POST['id_servico'];
    $nome_servico = $_POST['nome_servico'];
    $descricao_servico = $_POST['desc_servico'];
    $valor_servico = $_POST['valor_servico'];

    $updateServicoSQL = "UPDATE servicos SET nome_servico = :nome_servico, valor = :valor_servico, data_hora = CURRENT_TIME, descricao_servico = :descricao_servico  WHERE id_servico = :id_servico";
    $preparar = $conexao->prepare($updateServicoSQL);
    $preparar->execute([
        'nome_servico' => $nome_servico,
        'valor_servico' => $valor_servico,
        'descricao_servico' => $descricao_servico,
        'id_servico' => $id_servico
    ]);

    echo "Serviço atualizado com sucesso!";
    header("Location: ../views/listaServicos.php");
} else {
    echo "Não foi possível alterar.";
    header("Location: ../views/listaServicos.php");
}