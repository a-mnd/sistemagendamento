<?php
session_start();
include_once 'conexao.php';

$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados foram recebidos corretamente
if (isset($data['id_funcionario'], $data['id_acesso'], $data['acesso_ativo'])) {
    $idFuncionario = $data['id_funcionario']; // ID do funcionário
    $idAcesso = $data['id_acesso']; // ID do acesso 1, 2 ou 3
    $acessoAtivo = $data['acesso_ativo']; // 1 para ativo, 0 para inativo, isso faz parte dos checkbox

    // Verifica se é o único administrador antes de tentar excluir
    if ($idAcesso == 1 && $acessoAtivo == 0) {
        $verificaAdmins = $conexao->prepare("SELECT COUNT(*) FROM controle_acesso WHERE id_acesso = 1");
        $verificaAdmins->execute();
        $totalAdmins = $verificaAdmins->fetchColumn();
    
        if ($totalAdmins <= 1) {
            echo json_encode(['success' => false, 'message' => 'Não é possível remover o único administrador.']);
            exit();
        }
    }


    // Alterar ou adicionar o nível de acesso no banco de dados
    if ($acessoAtivo == 1) {
        // Adiciona um novo nível de acesso
        $insert = "INSERT INTO controle_acesso (id_funcionario, id_acesso) VALUES (:id_funcionario, :id_acesso)";
        $stmt = $conexao->prepare($insert);
        $stmt->bindParam(':id_funcionario', $idFuncionario);
        $stmt->bindParam(':id_acesso', $idAcesso);
        $stmt->execute();
    } else {
        // Remove o nível de acesso
        $delete = "DELETE FROM controle_acesso WHERE id_funcionario = :id_funcionario AND id_acesso = :id_acesso";
        $stmt = $conexao->prepare($delete);
        $stmt->bindParam(':id_funcionario', $idFuncionario);
        $stmt->bindParam(':id_acesso', $idAcesso);
        $stmt->execute();
    }

    // Atualiza os acessos do funcionário na sessão
    if ($_SESSION['id_funcionario'] == $idFuncionario) { 
        $selectAcesso = $conexao->prepare("SELECT id_acesso FROM controle_acesso WHERE id_funcionario = :id_funcionario");
        $selectAcesso->bindParam(':id_funcionario', $idFuncionario);
        $selectAcesso->execute();
        $acessos = $selectAcesso->fetchAll(PDO::FETCH_COLUMN);

        // Atualiza a variável de sessão apenas para o usuário logado
        $_SESSION['id_acessos'] = $acessos;
    }


    // Retorna a resposta de sucesso
    echo json_encode(['success' => true]);
} else {
    // Caso os dados não sejam enviados corretamente
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}
?>
