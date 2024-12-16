<?php
include_once "../admin/conexao.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_servico = $_POST['id_servico'] ?? '';
    if ($id_servico) {
        $excluirServicoSQL = $conexao->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
        $excluirServicoSQL->execute(['id_servico' => $id_servico]);
        header('location: ../views/listaServicos.php?msg=Excluido com sucesso');
    } else {
        echo "Não foi possível excluir o serviço.";
    }
} else {
    echo "Método de requisição inválido.";
}
