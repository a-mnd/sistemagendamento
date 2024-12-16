<?php
include_once "./conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_func = $_POST['nome'];
    $datanasc = $_POST['data_nascimento'];
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $cargo = $_POST['cargo'];
    $situacao = $_POST['situacao'];
    $senha = $_POST['senha'];

    $novo = [
        'nome' => $nome_func,
        'datanasc' => $datanasc,
        'contato' => $contato,
        'email' => $email,
        'cpf' => $cpf,
        'endereco' => $endereco,
        'cep' => $cep,
        'bairro' => $bairro,
        'complemento' => $complemento,
        'cidade' => $cidade,
        'uf' => $uf,
        'cargo' => $cargo,
        'situacao' => $situacao,
        'senha' => $senha
    ];

    $insert = $conexao->prepare("INSERT INTO funcionario (nome_funcionario, cpf, endereco, bairro, cidade, cep, uf, complemento, email, data_nascimento, senha, situacao, contato, id_cargo) VALUES (:nome, :cpf, :endereco, :bairro, :cidade, :cep, :uf, :complemento, :email, :datanasc, :senha, :situacao, :contato, :cargo)");

    if ($insert->execute($novo)) {
        $id_funcionario = $conexao->lastInsertId();

        // Verifica se há algum administrador no sistema
        $verificaAdmin = $conexao->prepare("SELECT COUNT(*) FROM controle_acesso WHERE id_acesso = 1");
        $verificaAdmin->execute();
        $existeAdmin = $verificaAdmin->fetchColumn();

        // Define o nível de acesso
        $id_acesso = ($existeAdmin == 0) ? 1 : 3;

        // Insere o nível de acesso no controle_acesso
        $insertAcesso = $conexao->prepare("INSERT INTO controle_acesso (id_funcionario, id_acesso) VALUES (:id_funcionario, :id_acesso)");
        $insertAcesso->bindParam(':id_funcionario', $id_funcionario);
        $insertAcesso->bindParam(':id_acesso', $id_acesso);
        $insertAcesso->execute();

        echo '<p> Cadastro realizado com sucesso </p>';
       // header('location: ../views/painelcolab.php?msg=Cadastro com sucesso');
    } else {
        echo '<p> Erro ao cadastrar  funcionário';
        //header('location: ../views/painelcolab.php?msg=Erro ao cadastrar funcionário');
    }
}
?>