<option value="">Horário</option>
<?php
include_once"../admin/conexao.php";
date_default_timezone_set('America/Sao_Paulo');
$iniciohora = new DateTime('08:00');
$fimhora = new DateTime('19:00');
$mesSelecionado = $_GET['mesCerto'] ?? '';
$diaSelecionado = $_GET['dia'] ?? '';
$ano = date('Y');
$dataAgendamento = new DateTime("$ano-$mesSelecionado-$diaSelecionado");
while ($iniciohora <= $fimhora) {
    $selectHora = $conexao->prepare("SELECT * FROM agendamento WHERE dia = :d AND TIME(hora) = TIME(:h);");
    $str_data = $dataAgendamento->format('Y-m-d');
    $selectHora->bindParam(':d', $str_data, PDO::PARAM_STR);
    $hora = $iniciohora->format('H:i');
    $selectHora->bindParam(':h', $hora, PDO::PARAM_STR);
    $selectHora->execute();
    if($rs = $selectHora->fetch(PDO::FETCH_ASSOC)) {
        // echo '<option value="">Indisponivel</option>';
    } else {    
        echo '<option value="' .$iniciohora->format('H:i'). '">' .$iniciohora->format('H:i'). '</option>';
    }
    $iniciohora->modify('+1 hour'); // de 1 em 1 hora
    //$iniciohora->modify('+30 minutes'); //de 30 em 30 minutos
}
