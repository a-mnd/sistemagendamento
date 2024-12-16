<?php
include_once "../admin/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cargo = $_POST['id_cargo'] ?? '';
    if ($id_cargo) {
        $excluirCargoSQL = $conexao->prepare("DELETE FROM cargo WHERE id_cargo = :id_cargo");
        $excluirCargoSQL->execute(['id_cargo' => $id_cargo]);
        //echo "Agendamento cancelado com sucesso!";
        header('location: ../views/listaCargos.php?msg=Excluido com sucesso');
    } else {
        echo "Não foi possível excluir o cargo.";
    }
} else {
    echo "Método de requisição inválido.";
}


//$sql ="SELECT id_agendamento, dia, hora, email, nome_cliente
//FROM agendamento 
//WHERE TIMESTAMP(dia, hora) <= NOW() - INTERVAL 1 HOUR
//AND a.email_enviado = 0;"

//$pre = $conexao->prepare($sql); $pre->execute();

    // while ($array = $pre->fetch(PDO::FETCH_ASSOC)) {
    //     $id_agendamento = $array['id_agendamento'];
    //     $email = $array['email'];
    //     $nome_cliente = $array['nome_cliente'];

    //     // Enviar e-mail de satisfação
    //     $to = $email;
    //     $subject = "Satisfação do Atendimento";
    //     $message = "Olá $nome_cliente,\n\nEsperamos que você tenha ficado satisfeito com o nosso atendimento. Por favor, nos dê seu feedback.\n\nObrigado!";
    //     $headers = "From: no-reply@seusite.com";

    //     if (mail($to, $subject, $message, $headers)) {
    //         // Atualizar o agendamento para marcar que o e-mail foi enviado
    //         $updateSQL = $conn->prepare("UPDATE agendamento SET email_enviado = 1 WHERE id_agendamento = :id_agendamento");
    //         $updateSQL->execute(['id_agendamento' => $id_agendamento]);
    //     }
    // }

    // echo "E-mails de satisfação enviados com sucesso!";  