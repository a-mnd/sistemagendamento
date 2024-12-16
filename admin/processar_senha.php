<?php
include_once "conexao.php";
// session_start();

//Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_funcionario = $_POST['id_funcionario'];
    $senha_atual = $_POST['senha'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    $dados_senha = [
        'id_funcionario' => $id_funcionario,
        //'senha' => $senha_atual,
        'nova_senha' => $nova_senha,
        //'confirmar_senha' => $confirmar_senha
    ];

    //Consulta para verificar a senha atual
    $select = $conexao->prepare('SELECT senha FROM funcionario WHERE id_funcionario = :id_funcionario');
    $select->bindParam(':id_funcionario', $id_funcionario);
    $select->execute();
    $res = $select->fetch(PDO::FETCH_ASSOC);

    if ($res['senha'] == $senha_atual) {
        if ($nova_senha == $confirmar_senha) {
            $atualizando_senha = $conexao->prepare("UPDATE funcionario SET senha = :nova_senha WHERE id_funcionario = :id_funcionario");
            // execultando a consulta com parâmetro
            if ($atualizando_senha->execute($dados_senha)) {
                //Se atualização for bem sucedida
                echo '<p> Senha atualizada com sucesso </p>';
               // header('Location: ../views/homecliente.php?msg=Senha atualizada com sucesso');
            } else {
                // Se houver erro na atualização
                echo '<p> Erro ao atualizar senha </p>';
                //header('Location: ../views/alterarsenha.php?msg=Erro ao atualizar senha');
            }
        } else {
            echo '<p> As senhas digitadas não são iguais </p>';
            //header('Location: ../views/alterarsenha.php?msg=As senhas digitadas não são iguais');
        }
    } else {
        echo '<p> Senha digitada não confere  com a senha atual </p>';
        //header('Location: ../views/alterarsenha.php?msg=Senha digitada não confere  com a senha atual');
    }

    //atualizando senha

}