<?php
include_once '../admin/conexao.php';
session_start();

$response = [ // Estrutura padrão para a resposta
    'status' => 'error',
    'message' => 'Ocorreu um erro. Tente novamente mais tarde.'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $cod_validacao = $_POST['cod_validacao'];

    $selectUser = $conexao->prepare("SELECT * FROM agendamento WHERE contato = :contato AND email = :email AND cod_validacao = :cod_validacao");
    if ($selectUser->execute(['contato' => $contato, 'email' => $email, 'cod_validacao' => $cod_validacao])) {
        $confirmarValidacao = $conexao->prepare("UPDATE agendamento SET validacao = 1 WHERE cod_validacao = :cod_validacao");
        if ($confirmarValidacao->execute(['cod_validacao' => $cod_validacao])) {
            $selectPhone = $conexao->prepare('SELECT * FROM agendamento WHERE contato = :contato');
            $selectPhone->bindParam('contato', $contato);
            $selectPhone->execute();
            $cliente = $selectPhone->fetch(PDO::FETCH_ASSOC);

            if ($cliente) {
                $nome_cliente = $cliente['nome_cliente'];
                $email = $cliente['email'];
                $validado = $cliente['validacao'];

                $_SESSION['contato'] = $contato;
                $_SESSION['email'] = $email;
                $_SESSION['nome_cliente'] = $nome_cliente;
                $_SESSION['validado'] = $validado;

                $response = [
                    'status' => 'success',
                    'message' => 'E-mail validado com sucesso. Aguarde '
                ];
            } else {
                $response['message'] = 'Dados não compativeis.';
            }
        } else {
            $response['message'] = 'Não conseguimos validar seu código.';
        }
    } else {
        $response['message'] = 'Combinação de contato, e-mail e código de validação não encontrada.';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit;