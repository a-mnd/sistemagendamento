<?php
include_once "../admin/conexao.php";
$id_agendamento = $_GET['id_agendamento'] ?? '';

$selectGeral = $conexao->prepare("SELECT a.dia, a.nome_cliente, a.contato, a.hora, a.id_funcionario, f.nome_funcionario, s.id_servico, s.nome_servico FROM agendamento a JOIN funcionario f ON a.id_funcionario = f.id_funcionario JOIN servicos s ON a.id_servico = s.id_servico WHERE a.id_agendamento = :id_agendamento");
$selectGeral->execute(['id_agendamento' => $id_agendamento]);

while ($array = $selectGeral->fetch(PDO::FETCH_ASSOC)) {
    $data = $array['dia'];
    $explode = explode('-', $data);

    $diaDividido = new DateTime($data);

    $dia = $diaDividido->format('d');

    $mesCerto = $diaDividido->format('m');

    $ano = $diaDividido->format('Y');

    $nome_cliente = $array['nome_cliente'];
    $contato = $array['contato'];
    $hora = $array['hora'];
    $id_funcionario = $array['id_funcionario'];
    $nome_funcionario = $array['nome_funcionario'];
    $id_servico = $array['id_servico'];
    $nome_servico = $array['nome_servico'];
}
?>
<div id="modalReagendar" style="z-index:1000;">
    <div class="divFlex">
        <form id="reagendamentoForm" method="post" action="../admin/atualizar_agendamento.php">
            <input type="hidden" name="id_agendamento" id="id_agendamento" value="<?= $id_agendamento ?>">
            <div class="data">
                <h1 class="escolha"> Escolha uma data</h1>
                <input type="date" name="data" id="dia" class="novodia" value="<?= $data ?>">

            </div>
            <div class="container-inputs">
                <div class="grupo-input">
                    <label for="name">Nome</label>
                    <input type="text" class="name" name="nome" value="<?= $nome_cliente ?>" readonly>
                </div>
                <div class="infodois">
                    <div class="grupo-input">
                        <label for="func">Profissional</label>
                        <select name="profissional" id="func" class="funcionario">
                            <option value="<?= $id_funcionario ?>"><?= $nome_funcionario ?></option> <!--selected -->
                            <?php
                            $pegando_funcionario = "SELECT * FROM funcionario ORDER BY nome_funcionario";
                            $preparando = $conexao->prepare($pegando_funcionario);
                            $preparando->execute();
                            while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                                $id_func = $array['id_funcionario'];
                                $nome_func = $array['nome_funcionario'];
                            ?>
                                <option value="<?php echo $id_func; ?>">
                                    <?php echo $nome_func; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="grupo-input">
                        <label for="serv">Procedimento</label>
                        <select name="servico" id="serv" class="servicos">
                            <option value="<?= $id_servico ?>"> <?= $nome_servico ?></option>
                            <?php
                            $pegando_servico = "SELECT * FROM servicos ORDER BY nome_servico";
                            $preparando = $conexao->prepare($pegando_servico);
                            $preparando->execute();
                            while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                                $id_serv = $array['id_servico'];
                                $nome_serv = $array['nome_servico'];
                            ?>
                                <option value="<?php echo $id_serv; ?>">
                                    <?php echo $nome_serv; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="grupo-input">
                    <label for="contato">Contato</label>
                    <input type="text" name="contato" id="contato" class="tel" value="<?= $contato ?>">
                </div>
            </div>
            <div class="bottom-form horario">
                <div class="grupo-input">
                    <select name="hora" id="hora" class="horario">
                        <option value=""><?= $hora ?></option>
                        <?php
                        $arrayHora = optionHora($dia, $mesCerto, $conexao);
                        foreach ($arrayHora as $option) {
                            echo '<option value="' . $option . '">' . $option . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="confirmar">Reagendar</button>
            <!-- <button typer="button" class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button> -->
        </form>
    </div>
</div>

<script>
    document.querySelector('.confirmar').addEventListener('click', function() {
        const id_agendamento = document.getElementById('id_agendamento').value;
        window.location.href = '../admin/atualizar_agendamento.php?id_agendamento=' + id_agendamento;
    });

    document.querySelector('.fechar').addEventListener('click', function() {
        window.location.href = 'NewhistoricoAgend.php';
    });
</script>
<?php

function optionHora($diaSelecionado, $mesSelecionado, $conexao)
{

    date_default_timezone_set('America/Sao_Paulo');
    $iniciohora = new DateTime('08:00');
    $fimhora = new DateTime('19:00');

    $ano = date('Y');
    $dataAgendamento = new DateTime("$ano-$mesSelecionado-$diaSelecionado");
    $arrayHoras = [];
    while ($iniciohora <= $fimhora) {
        $selectHora = $conexao->prepare("SELECT * FROM agendamento WHERE dia = :d AND TIME(hora) = TIME(:h);");
        $str_data = $dataAgendamento->format('Y-m-d');
        $selectHora->bindParam(':d', $str_data, PDO::PARAM_STR);
        $hora = $iniciohora->format('H:i');
        $selectHora->bindParam(':h', $hora, PDO::PARAM_STR);
        $selectHora->execute();
        if ($rs = $selectHora->fetch(PDO::FETCH_ASSOC)) {
            // echo '<option value="">Indisponivel</option>';
        } else {
            $arrayHoras[] = $iniciohora->format('H:i');
            // echo '<option value="' .$iniciohora->format('H:i'). '">' .$iniciohora->format('H:i'). '</option>';
        }
        $iniciohora->modify('+1 hour'); // de 1 em 1 hora
        //$iniciohora->modify('+30 minutes'); //de 30 em 30 minutos
    }
    return $arrayHoras;
}
?>