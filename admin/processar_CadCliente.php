<?php
include_once "./conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome_cliente = $_POST['nome'];
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];

    $novo = [
        'nome' => $nome_cliente,
        'contato' => $contato,
        'email' => $email,
        'cpf' => $cpf,
        'endereco' => $endereco,
        'cep' => $cep,
        'bairro' => $bairro,
        'complemento' => $complemento,
        'cidade' => $cidade,
        'uf' => $uf,
        'senha' => $senha,
        'data_nascimento' => $data_nascimento
    ];

    $insert = $conexao->prepare("INSERT INTO cliente (nome_cliente, cpf, endereco, bairro, cidade, cep, uf, complemento, email, senha, contato, data_nascimento) VALUES (:nome, :cpf, :endereco, :bairro, :cidade, :cep, :uf, :complemento, :email, :senha, :contato, :data_nascimento)");

    if($insert->execute($novo)) {
        header('location: ../views/cadastrocliente.php?msg=Cadastro com sucesso');
    } else {
        header('location ../views/cadastrocliente.php?msg=Erro ao cadastrar funcionário');
    }
}
?>