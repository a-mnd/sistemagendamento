<?php
include_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = $_POST['email']; 
    $senha = $_POST['password'];

    // Consulta o funcionário pelo email
    $selectEmail = $conexao->prepare("SELECT * FROM funcionario WHERE email = :email");
    $selectEmail->bindParam('email', $email); 
    $selectEmail->execute();
    $funcionario = $selectEmail->fetch(PDO::FETCH_ASSOC);
    if ($funcionario) {
        $id_funcionario = $funcionario['id_funcionario'];
        $nome_funcionario = $funcionario['nome_funcionario'];
        $senha_funcionario = $funcionario['senha'];
        $email_funcionario = $funcionario['email'];

        // Verifica se o email e a senha são válidos
        if ($email == $email_funcionario && $senha == $senha_funcionario) { 
            // Inicia a sessão
            session_start(); // Inicia a sessão do PHP

            // Armazena dados do funcionário na sessão
            $_SESSION['email'] = $email_funcionario;
            $_SESSION['nome'] = $nome_funcionario;
            $_SESSION['id_funcionario'] = $id_funcionario;

            // Consulta para obter os níveis de acesso do funcionário
            $selectAcesso = $conexao->prepare("SELECT id_acesso FROM controle_acesso WHERE id_funcionario = :id_funcionario");
            $selectAcesso->bindParam(':id_funcionario', $id_funcionario);
            $selectAcesso->execute(); // Executa a consulta para os níveis de acesso
                    
            // Armazena todos os níveis de acesso em um array
            $acessos = $selectAcesso->fetchAll(PDO::FETCH_COLUMN); // Pega todos os id_acesso como um array
                    
            if ($acessos) { // Se os níveis de acesso foram encontrados
                $_SESSION['id_acessos'] = $acessos; // Armazena todos os níveis de acesso na sessão
            } else {
                // Caso o funcionário não tenha níveis de acesso, define um padrão (opcional)
                $_SESSION['id_acessos'] = []; // Define os acessos como um array vazio
            }
            
            // Redireciona para a página inicial
            header('location: ../views/homeEstab.php');
 
        } else {
            echo "Login ou senha inválidos."; // Mensagem de erro para login inválido
        }
    } else {
        echo "Login ou senha inválidos"; // Mensagem de erro se o funcionário não foi encontrado
    }
}