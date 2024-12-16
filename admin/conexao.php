<?php
$host = "localhost";
$banco = "sistemaagendamento";
$user = "root";
$senha = "";
$conexao = new PDO("mysql:host=$host;dbname=$banco", $user, $senha);
if(!$conexao) {
    echo "Não foi :(";
}