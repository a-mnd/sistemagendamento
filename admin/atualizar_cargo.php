<?php
include_once "../admin/conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_cargo = $_POST['id_cargo'];
    $nome_cargo = $_POST['nome_cargo'];


    $updateCargoSQL = "UPDATE cargo SET nome_cargo = :nome_cargo  WHERE id_cargo = :id_cargo";
    $preparar = $conexao->prepare($updateCargoSQL);
    $preparar->execute([
        'nome_cargo' => $nome_cargo,
        'id_cargo' => $id_cargo
    ]);

    echo "Cargo atualizado com sucesso!";
    header("Location: ../views/listaCargos.php");
} else {
    echo "Não foi possível alterar.";
    header("Location: ../views/listaCargos.php");
}
