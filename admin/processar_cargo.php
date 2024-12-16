<?php
include_once "./conexao.php"; 


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $cargo = $_POST['cargo'];

$novo = [
    'cargo' => $cargo
];
    /* Insere no banco de dados */
    $insert = $conexao->prepare("INSERT INTO cargo (nome_cargo) VALUES (:cargo)");
    if ($insert->execute($novo)) {
        header('location: ../views/cadastroservico.php?msg=Cadastro com sucesso');
    } else {
        header('location: ../views/cadastroservico.php?msg=Não foi possivel cadastrar');
    }
}