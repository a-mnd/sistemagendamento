<?php
include_once "../admin/conexao.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_agendamento = $_POST['id_agendamento'] ?? '';
    if ($id_agendamento) {
        $cancelarSQL = $conexao->prepare("DELETE FROM agendamento WHERE id_agendamento = :id_agendamento");
        $cancelarSQL->execute(['id_agendamento' => $id_agendamento]);
        //echo "Agendamento cancelado com sucesso!";
        header('location: historico.php?msg=Cancelado com sucesso');
    } else {
        echo "Não foi possível cancelar o agendamento.";
    }
} else {
    echo "Método de requisição inválido.";
}