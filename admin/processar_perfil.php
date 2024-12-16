<?php
//session_start();// iniciando a sessão
include_once "conexao.php";
 //verificando se está logado.
//if (isset($_SESSION['nome'])) {
    //echo "<h2>Bem-vindo, " . $_SESSION['nome'] . "!</h2>";
   // $id_cliente = $_SESSION['id_cliente'];
//} else {
   // echo "<h2>Você ainda não está logado.</h2>";
//}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //obtém os dados enviados pelo formulário
    $id_cliente = $_POST['id_cliente'];
    $nome_cliente = $_POST['nome_cliente'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); //Criptografando a senha

    // criando um array associativo com os valores dos campos
    $dadosperfil = [
        'id_cliente' => $id_cliente,
        'nome_cliente' => $nome_cliente,
        'email' => $email,
        'contato' => $contato,
        'data_nascimento' => $data_nascimento,
        'cpf' => $cpf,
        'endereco' => $endereco,
        'cep' => $cep,
        'bairro' => $bairro,
        'complemento' => $complemento,
        'cidade' => $cidade,
        'uf' => $uf,
        'senha' => $senha
    ];

    //echo "<pre>";
    //print_r($dadosperfil);
    //Preparando a consulta de atualização
    $atualizando_perfil = $conexao->prepare("UPDATE cliente SET nome_cliente = :nome_cliente, email = :email, contato = :contato, data_nascimento = :data_nascimento, cpf = :cpf, endereco = :endereco, cep = :cep, bairro = :bairro, complemento = :complemento, cidade = :cidade, uf = :uf, senha = :senha WHERE id_cliente = :id_cliente");

    //Execultando a consulta com parâmetros
    if ($atualizando_perfil->execute($dadosperfil)) {
        // Se  atualização for bem sucedida
        header('Location: ../views/homecliente.php?msg=Cadastro atualizado com sucesso');
    } else {
        //Se houver erro na atualização
        header('Location: ../views/cadastrocliente.php?msg=Erro ao atualizar cliente');
    }
}
