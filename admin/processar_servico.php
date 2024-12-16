<?php
include_once "./conexao.php"; 


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome_servico = $_POST['nomeservico'];
    $descricao_servico = $_POST['descricao'];
    $preco = $_POST['preco'];

$novo = [
    'servico' => $nome_servico,
    'descricao_servico' => $descricao_servico,
    'preco' => $preco

];
    /* Insere no banco de dados */
    $insert = $conexao->prepare("INSERT INTO servicos (nome_servico, valor, data_hora, descricao_servico) VALUES (:servico, :preco, CURRENT_TIME, :descricao_servico)");
    if ($insert->execute($novo)) {
        header('location: ../views/cadastroservico.php?msg=Cadastro com sucesso');
    } else {
        header('location: ../views/cadastroservico.php?msg=Não foi possivel cadastrar');
    }
}