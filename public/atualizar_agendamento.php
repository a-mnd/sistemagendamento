<?php
include_once "../admin/conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_agendamento = $_POST['id_agendamento'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $id_funcionario = $_POST['profissional'];
    $id_servico = $_POST['servico'];
    $contato = $_POST['contato'];

    $data_formatada = date('Y-m-d', strtotime($data));


    $updateSQL = "UPDATE agendamento SET dia = :data, hora = :hora, id_funcionario = :id_funcionario, id_servico = :id_servico, contato = :contato WHERE id_agendamento = :id_agendamento";
    $preparar = $conexao->prepare($updateSQL);
    $preparar->execute([
        'data' => $data_formatada,
        'hora' => $hora,
        'id_funcionario' => $id_funcionario,
        'id_servico' => $id_servico,
        'contato' => $contato,
        'id_agendamento' => $id_agendamento
    ]);

    //echo "Agendamento atualizado com sucesso!";
    header("Location: historico.php?msg=Reagendado com sucesso");
} else {
    //echo "Não foi possível reagendar.";
    header("Location: historico.php?msg=Nao foi possivel reagendar");
}