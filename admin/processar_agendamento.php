<?php
include_once "./conexao.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Sao_Paulo');
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $nome = $_POST['nome'];
    $profissional = $_POST['profissional'];
    $servico = $_POST['servico'];
    $contato = $_POST['contato'];
    $hora = $_POST['hora'];
    $email = $_POST['email'];
    $dia = $_POST['dia'];
    $mesString = $_POST['mes'];

    $mesInt = [
        'Janeiro' => 1,
        'Fevereiro' => 2,
        'Março' => 3,
        'Abril' => 4,
        'Maio' => 5,
        'Junho' => 6,
        'Julho' => 7,
        'Agosto' => 8,
        'Setembro' => 9,
        'Outubro' => 10,
        'Novembro' => 11,
        'Dezembro' => 12
    ];
    $mes = $mesInt[$mesString];

    $ano = date('Y');
    $dataSelecionada = new DateTime("$ano-$mes-$dia");//, $timezone
    $dataSelecionada = $dataSelecionada->format('Y-m-d');



    $checarCli = $conexao->prepare("SELECT * FROM agendamento WHERE email = :email AND contato = :contato");
    $checarCli->execute(['email' => $email, 'contato' => $contato]);

    // Caso o cliente já tenha o código validado irá agendar normalmente porém sem gerar um código e futuramente gerar um link de validação.
    if($checarCli->rowCount() > 0) {
        $dados = $checarCli->fetch(PDO::FETCH_ASSOC);
        if($dados['cod_validacao']) {
            $novo = [
                'nome' => $nome,
                'profissional' => $profissional,
                'servico' => $servico,
                'contato' => $contato,
                'hora' => $hora,
                'email' => $email,
                'dataSelecionada' => $dataSelecionada
            ];
            $insertAgendamento = $conexao->prepare("INSERT INTO agendamento (id_funcionario, id_servico, dia, hora, contato, nome_cliente, email) VALUES (:profissional, :servico, :dataSelecionada, :hora, :contato, :nome, :email)");
        
            if ($insertAgendamento->execute($novo)) {
                // header('location: ../views/agendamento.php?msg=Agendado com sucesso');
                echo "Agendado com sucesso";
            } else {
                // header('location ../views/agendamento.php?msg=Erro ao agendar');
                echo "Não Agendado com sucesso";
            }
        }
    } else { // Caso o cliente nunca tenha feito um agendamento, será gerado um código de validação, junto ao link que será enviado ao e-mail que ele cadastrou
        $cod_validacao = md5(uniqid(rand(), true)) . date('YmdHis');
        $novo = [
            'nome' => $nome,
            'profissional' => $profissional,
            'servico' => $servico,
            'contato' => $contato,
            'hora' => $hora,
            'email' => $email,
            'dataSelecionada' => $dataSelecionada,
            'cod_validacao' => $cod_validacao
        ];
        $insertAgendamento = $conexao->prepare("INSERT INTO agendamento (id_funcionario, id_servico, dia, hora, contato, nome_cliente, email, cod_validacao) VALUES (:profissional, :servico, :dataSelecionada, :hora, :contato, :nome, :email, :cod_validacao)");
    
        if ($insertAgendamento->execute($novo)) {
            // header('location: ../views/NewhistoricoAgend.php?msg=Agendado com sucesso');
            echo "Agendado com sucesso<br>";
            // Arquivo para envio de e-mail
            include_once '../emails/mail.php';
        } else {
            // header('location ../views/agendamento.php?msg=Erro ao agendar');
            echo "Não Agendado com sucesso";
        }
    }
}