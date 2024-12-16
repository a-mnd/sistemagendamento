<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/relatorio.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once '../admin/conexao.php';
    ?>

    <main>
        <section>
            <h1>Relatório</h1>
            <div class="container">
                <div class="containerCards">
                    <div class="cards">
                        <div class="iconCard">
                            <img src="../imgs/iconLucro.svg" alt="Icone de cifrão">
                        </div>
                        <div class="contTexto">
                            <h4>Lucro</h4>
                            <?php

                            $selectLucro = "SELECT DATE_FORMAT(a.dia, '%Y-%m') AS mes, SUM(s.valor) AS lucro_total FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico WHERE a.dia >= DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND a.dia < DATE_FORMAT(CURDATE() + INTERVAL 1 MONTH,'%Y-%m-01') GROUP BY DATE_FORMAT(a.dia, '%Y-%m');";
                            $preparando = $conexao->prepare($selectLucro);
                            $preparando->execute();
                            while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                                $lucro = $array['lucro_total'];

                                echo "<p>R$ $lucro</p>";
                            }
                            ?>
                        </div>
                        <?php
                        $mesAnt = date('Y-m', strtotime('-1 month'));
                        $sqlLucroAnterior = $conexao->prepare("SELECT SUM(s.valor) AS lucro_anterior FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico WHERE DATE_FORMAT(a.dia, '%Y-%m') = :mesAnterior");
                        $sqlLucroAnterior->execute(['mesAnterior' => $mesAnt]);
                        $lucroAnterior = $sqlLucroAnterior->fetch(PDO::FETCH_ASSOC)['lucro_anterior'];

                        $mesAtual = date('Y-m');
                        $sqlLucroAtual = $conexao->prepare("SELECT SUM(s.valor) AS lucro_atual FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico WHERE DATE_FORMAT(a.dia, '%Y-%m') = :mesAtual");
                        $sqlLucroAtual->execute(['mesAtual' => $mesAtual]);
                        $lucroAtual = $sqlLucroAtual->fetch(PDO::FETCH_ASSOC)['lucro_atual'];

                        if ($lucroAnterior != 0) {
                            $comparativoMesAnterior = (($lucroAtual - $lucroAnterior) / $lucroAnterior) * 100;
                            echo "<span>" . round($comparativoMesAnterior) . "%</span>";
                        } else {
                            $comparativoMesAnterior = 0; // Evitar divisão por zero 
                        }
                        ?>
                    </div>
                    <div class="cards">
                        <div class="iconCard">
                            <img src="../imgs/iconAgend.svg" alt="Icone de cifrão">
                        </div>
                        <div class="contTexto">
                            <h4>Agendamentos</h4>
                            <?php
                            //$selectSeparandooTotaldeAgendamentoemMeses= "SELECT DATE_FORMAT(dia, '%Y-%m') AS mes, COUNT(id_agendamento) AS total_agendamentos FROM agendamento GROUP BY mes;"
                            $selectTotalAgend = "SELECT DATE_FORMAT(dia, '%Y-%m') AS mes, COUNT(id_agendamento) AS total_agendamentos FROM agendamento WHERE dia >= DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND dia < DATE_FORMAT(CURDATE() + INTERVAL 1 MONTH,'%Y-%m-01') GROUP BY DATE_FORMAT(dia, '%Y-%m');"; //select do mes atual
                            $preparar = $conexao->prepare($selectTotalAgend);
                            $preparar->execute();
                            while ($array = $preparar->fetch(PDO::FETCH_ASSOC)) {
                                $totalAgend = $array['total_agendamentos'];
                                echo "<p>$totalAgend</p>";
                            }
                            ?>
                        </div>
                        <?php
                        $mesAnt1 = date('Y-m', strtotime('-1 month'));
                        $sqlAgendAnterior = $conexao->prepare("SELECT COUNT(id_agendamento) AS total_ant_agendamentos FROM agendamento WHERE DATE_FORMAT(dia, '%Y-%m') = :mesAnterior");
                        $sqlAgendAnterior->execute(['mesAnterior' => $mesAnt1]);
                        $totalAgendamentosAnterior = $sqlAgendAnterior->fetch(PDO::FETCH_ASSOC)['total_ant_agendamentos'];

                        $mesAtual1 = date('Y-m');
                        $sqlAgendAtual = $conexao->prepare("SELECT COUNT(id_agendamento) AS total_atu_agendamentos FROM agendamento WHERE DATE_FORMAT(dia, '%Y-%m') = :mesAtual");
                        $sqlAgendAtual->execute(['mesAtual' => $mesAtual1]);
                        $totalAgendamentosAtual = $sqlAgendAtual->fetch(PDO::FETCH_ASSOC)['total_atu_agendamentos'];

                        if ($totalAgendamentosAnterior != 0) {
                            $comparativoMesAnterior1 = (($totalAgendamentosAtual - $totalAgendamentosAnterior) / $totalAgendamentosAnterior) * 100;
                            echo "<span>" . round($comparativoMesAnterior1) . "%</span>";
                        } else {
                            $comparativoMesAnterior1 = 0; // Evitar divisão por zero 
                        }
                        ?>
                    </div>
                    <div class="cards">
                        <div class="iconCard">
                            <img src="../imgs/iconNovoCli.svg" alt="Icone de cifrão">
                        </div>
                        <div class="contTexto">
                            <h4>Novos Clientes</h4>
                            <?php
                            $selectNovosClientes = "SELECT COUNT(DISTINCT email) AS novos_clientes FROM agendamento WHERE DATE_FORMAT(dia, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') AND email NOT IN ( SELECT email FROM agendamento WHERE dia < DATE_FORMAT(CURDATE(), '%Y-%m-01') );";
                            $prepara = $conexao->prepare($selectNovosClientes);
                            $prepara->execute();
                            while ($array = $prepara->fetch(PDO::FETCH_ASSOC)) {
                                $novosClientes = $array['novos_clientes'];
                            }
                            echo "<p>$novosClientes<?p>";
                            ?>
                        </div>
                        <?php
                        $mesAnterior2 = date('Y-m', strtotime('-1 month'));
                        $sqlClienteAnterior = $conexao->prepare("SELECT COUNT(*) AS total_anterior_clientes FROM agendamento WHERE DATE_FORMAT(dia, '%Y-%m') = :mesAnterior");
                        $sqlClienteAnterior->execute(['mesAnterior' => $mesAnterior2]);
                        $totalClientesAnterior = $sqlClienteAnterior->fetch(PDO::FETCH_ASSOC)['total_anterior_clientes'];

                        $mesAtual2 = date('Y-m');
                        $sqlClienteAtual = $conexao->prepare("SELECT COUNT(*) AS total_atual_clientes FROM agendamento WHERE DATE_FORMAT(dia, '%Y-%m') = :mesAtual");
                        $sqlClienteAtual->execute(['mesAtual' => $mesAtual2]);
                        $totalClientesAtual = $sqlClienteAtual->fetch(PDO::FETCH_ASSOC)['total_atual_clientes'];

                        if ($totalClientesAnterior != 0) {
                            $comparativoMesAnterior2 = (($totalClientesAtual - $totalClientesAnterior) / $totalClientesAnterior) * 100;
                            echo "<span>" . round($comparativoMesAnterior2) . "%</span>";
                        } else {
                            $comparativoMesAnterior2 = 0; // Evitar divisão por zero 
                        }
                        ?>
                    </div>
                    <div class="cards">
                        <div class="iconCard">
                            <img src="../imgs/iconTaSucesso.svg" alt="Icone de cifrão">
                        </div>
                        <div class="contTexto">
                            <h4>Taxa de Sucesso</h4>
                            <?php
                            //AVG faz a média 
                            $selectMediaAvaliativa = "SELECT DATE_FORMAT(data_hora, '%Y-%m') AS mes, AVG(nota) AS media_avaliacao FROM avaliacao WHERE DATE_FORMAT(data_hora, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') GROUP BY DATE_FORMAT(data_hora, '%Y-%m');";
                            $prep = $conexao->prepare($selectMediaAvaliativa);
                            $prep->execute();
                            while ($array = $prep->fetch(PDO::FETCH_ASSOC)) {
                                $mediaAvaliacao = $array['media_avaliacao'];
                                echo "<p>" . round($mediaAvaliacao) . "</p>";
                            }
                            ?>
                        </div>
                        <?php
                        $mesAnterior3 = date('Y-m', strtotime('-1 month'));
                        $sqlAvaliacaoAnterior = $conexao->prepare("SELECT AVG(nota) AS media_ant_avaliacao FROM avaliacao WHERE DATE_FORMAT(data_hora, '%Y-%m') = :mesAnterior");
                        $sqlAvaliacaoAnterior->execute(['mesAnterior' => $mesAnterior3]);
                        $mediaAvaliacaoAnterior = $sqlAvaliacaoAnterior->fetch(PDO::FETCH_ASSOC)['media_ant_avaliacao'];

                        $mesAtual3 = date('Y-m');
                        $sqlAvaliacaoAtual = $conexao->prepare("SELECT AVG(nota) AS media_atu_avaliacao FROM avaliacao WHERE DATE_FORMAT(data_hora, '%Y-%m') = :mesAtual");
                        $sqlAvaliacaoAtual->execute(['mesAtual' => $mesAtual3]);
                        $mediaAvaliacaoAtual = $sqlAvaliacaoAtual->fetch(PDO::FETCH_ASSOC)['media_atu_avaliacao'];

                        if ($mediaAvaliacaoAnterior != 0) {
                            $comparativoMesAnterior3 = (($mediaAvaliacaoAtual - $mediaAvaliacaoAnterior) / $mediaAvaliacaoAnterior) * 100;
                            echo "<span>" . round($comparativoMesAnterior3) . "%</span>";
                        } else {
                            $comparativoMesAnterior3 = 0; // Evitar divisão por zero
                        }
                        ?>
                    </div>
                </div>
                <div class="graficoServicos">
                    <?php
                    $selectQTDEdeServico = "SELECT s.nome_servico, COUNT(*) AS total_agendamentos FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico WHERE DATE_FORMAT(a.dia, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') GROUP BY s.nome_servico ORDER BY s.nome_servico";
                    $sql = $conexao->prepare($selectQTDEdeServico);
                    $sql->execute();
                    $labels = [];
                    $data = [];
                    while ($array = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $labels[] = $array['nome_servico'];
                        $data[] = $array['total_agendamentos'];
                    }
                    ?>
                    <canvas id="grafico1"></canvas>
                </div>
                <div class="graficoPorDia">
                    <?php
                    $selectQTDEporDIA = "SELECT s.nome_servico, CASE DAYOFWEEK(a.dia) WHEN 1 THEN 'Domingo' WHEN 2 THEN 'Segunda-feira' WHEN 3 THEN 'Terça-feira' WHEN 4 THEN 'Quarta-feira' WHEN 5 THEN 'Quinta-feira' WHEN 6 THEN 'Sexta-feira' WHEN 7 THEN 'Sábado' END AS dia_semana, COUNT(*) AS total_agendamentos FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico WHERE DATE_FORMAT(a.dia, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') GROUP BY s.nome_servico, DAYOFWEEK(a.dia) ORDER BY s.nome_servico, dia_semana;";
                    $sql1 = $conexao->prepare($selectQTDEporDIA);
                    $sql1->execute();
                    $data1 = [];
                    $labels1 = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
                    while ($array1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                        $data1[$array1['nome_servico']][$array1['dia_semana']] = $array1['total_agendamentos'];
                    }
                    $datasets = [];
                    foreach ($data1 as $servico => $dias) {
                        $dataset = [
                            'label' => $servico,
                            'data' => [],
                            'borderColor' => 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 1)',
                            'fill' => false
                        ];
                        foreach ($labels1 as $dia) {
                            $dataset['data'][] = isset($dias[$dia]) ? $dias[$dia] : 0;
                        }
                        $datasets[] = $dataset;
                    }
                    ?>
                    <canvas id="grafico2"></canvas>
                </div>
            </div>
        </section>
    </main>
    <!-- <?php
            include_once 'footer.php';
            ?> -->
    <footer>
        <p>Empresa Desenvolvedor Fulana de Tal</p>
    </footer>
    <!-- <script src="/Js/historicoAgendamento.js"></script> -->
    <script>
        // GRÁFICO DE SERVIÇO AGENDADO
        const ctx1 = document.getElementById('grafico1');

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>, //['Corte de cabelo', 'Manicure', 'Pedicure', 'Limpeza de pele', 'Hidratação facial']
                datasets: [{
                    label: 'Serviço agendado',
                    data: <?php echo json_encode($data); ?>, //[12, 19, 3, 5, 2, 3]
                    borderWidth: 0,
                    backgroundColor: '#E61C62',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // GRÁFICO DE DIAS QUE TÊM MAIS AGENDAMENTO
        const ctx2 = document.getElementById('grafico2');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels1); ?>, // Dias da semana['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado']
                datasets: <?php echo json_encode($datasets); ?>
                    },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    <script src="../js/menu.js"></script>
</body>

</html>