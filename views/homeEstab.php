<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/homeEstab.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once '../admin/conexao.php';
    ?>
    <main>
        <section>
            <div class="recagen" id="recagen">
                <p>Olá,</p>
                <?php
                $selectAgendamentos = "SELECT COUNT(*) AS agnd_hj FROM agendamento WHERE dia = CURRENT_DATE();";
                $preparando = $conexao->prepare($selectAgendamentos);
                $preparando->execute();
                if ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                    $agnd_hj = $array['agnd_hj'];
                    echo "<h3>Você tem $agnd_hj agendamentos hoje!</h3>";
                }
                ?>
            </div>
            <div class="observacoes" id="observa">
                <h3>Observações do dia:</h3>
                <?php
                $selectAgend = "SELECT f.nome_funcionario AS funcionario, s.nome_servico AS servico, COUNT(a.id_agendamento) AS total_agendamentos FROM agendamento a JOIN funcionario f ON a.id_funcionario = f.id_funcionario JOIN servicos s ON a.id_servico = s.id_servico WHERE a.dia = CURRENT_DATE() GROUP BY f.nome_funcionario, s.nome_servico;";
                $preparando = $conexao->prepare($selectAgend);
                $preparando->execute();
                while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                    $funcionario = $array['funcionario'];
                    $total_agendamentos = $array['total_agendamentos'];
                    $servico = $array['servico'];

                    echo "<p class='obs'><strong>$funcionario</strong> tem $total_agendamentos agendamentos de $servico.</p>";
                }
                ?>
            </div>
            <div class="containerCalendario">
                <div class="calendario" id="calendario">
                <h2 id="mesAno"></h2>
                    <table class="datatabela">
                        <thead>
                            <tr>
                                <th>D</th>
                                <th>S</th>
                                <th>T</th>
                                <th>Q</th>
                                <th>Q</th>
                                <th>S</th>
                                <th>S</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>
    <script src="../js/calendario.js"></script>
</body>

</html>