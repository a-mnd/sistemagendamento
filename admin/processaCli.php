<?php
include_once '../admin/conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contato = $_POST['contato'];

    // print_r($dados);

    $selectPhone = $conexao->prepare('SELECT * FROM agendamento WHERE contato = :contato');
    $selectPhone->bindParam('contato', $contato);
    $selectPhone->execute();
    $cliente = $selectPhone->fetch(PDO::FETCH_ASSOC);

    if($cliente) {
        $nome_cliente = $cliente['nome_cliente'];
        $email = $cliente['email'];
        $validado = $cliente['validacao'];
        
        if($contato == $contato) {
            session_start();
            $_SESSION['contato'] = $contato;
            $_SESSION['email'] = $email;
            $_SESSION['nome_cliente'] = $nome_cliente;
            $_SESSION['validado'] = $validado;

            header('location: ../public/homecliente.php?msg=Deu certo');
        } else {
            echo "Erro no login";
        }
    }
}
?>