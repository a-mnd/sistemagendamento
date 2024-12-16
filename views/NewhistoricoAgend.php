<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historico de Agendamento</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/modais.css">
    <link rel="stylesheet" href="../css/tabelas.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once '../admin/conexao.php';
    include_once 'menu.php';
    ?>

    <main>
        <section>
            <h1>Histórico de Agendamento </h1>
            <form action="#" method="POST" class="input-select" id="form-meses">
                <select name="mes" id="mes" onchange="this.form.submit()">
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
            </form>
            <div class="table-container">
                <table class="tabelas" id="tabela-historico">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Serviço</th>
                            <th>Horário</th>
                            <th>Profissional</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // verificação para usuário comum 
                        //session_start(); 
                        // Verifica se o cliente está logado 
                        //if (!isset($_SESSION['email']) || !isset($_SESSION['contato'])) { 
                        //echo "<tr><td colspan='8'>Você precisa estar logado para ver o histórico de agendamentos.</td></tr>"; 
                        //exit; 
                        //} 
                        //$email_cliente = $_SESSION['email'];
                        //$contato_cliente = $_SESSION['contato'];
                        //SQL PARA USUARIO 
                        //$sql2 = "SELECT a.id_agendamento, a.dia, s.nome_servico, a.horario, f.nome_funcionario, a.nome_cliente FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico JOIN funcionarios f ON a.id_funcionario = f.id_funcionario JOIN WHERE DATE_FORMAT(a.dia, '%Y-%m') = :ano_mes AND a.email = :email_cliente AND a.contato = :contato_cliente"; 
                        //$prep2 = $conexao->prepare($sql2); 
                        //$prep2->execute(['ano_mes' => "$ano-$mes", 'email_cliente' => $email_cliente, 'contato_cliente' => $contato_cliente]);


                        if (isset($_POST['mes'])) {
                            $mes = $_POST['mes'];
                            $ano = date('Y');
                            $sql = "SELECT a.id_agendamento, a.dia, s.nome_servico, a.hora, f.nome_funcionario, a.nome_cliente FROM agendamento a JOIN servicos s ON a.id_servico = s.id_servico JOIN funcionario f ON a.id_funcionario = f.id_funcionario WHERE DATE_FORMAT(a.dia, '%Y-%m') = :ano_mes ";
                            $prep = $conexao->prepare($sql);
                            $prep->execute(['ano_mes' => "$ano-$mes"]);
                            if ($prep->rowCount() > 0) {
                                while ($array = $prep->fetch(PDO::FETCH_ASSOC)) {
                                    $id_agendamento = $array['id_agendamento'];
                                    $nome_cliente = $array['nome_cliente'];
                                    $servico = $array['nome_servico'];
                                    $profissional = $array['nome_funcionario'];
                                    $data = $array['dia'];
                                    $diaDividido = new DateTime($data);
                                    $dia = $diaDividido->format('d');
                                    $mesCerto = $diaDividido->format('m');
                                    $ano = $diaDividido->format('Y');
                                    $hora = $array['hora'];


                                    echo "<tr>
                                            <td>$id_agendamento</td>
                                            <td>$nome_cliente</td>
                                            <td>" . $dia . "/" . $mesCerto . "/" . $ano . "</td>
                                            <td>$servico</td>
                                            <td id='id_hora'>$hora</td>
                                            <td>$profissional</td>
                                            <td><button value ='$id_agendamento'id='cancelar' class='cancelar'>Cancelar</button></td>
                                            <td><button value='$id_agendamento' id='reagendar' class='reagendar'>Reagendar</button></td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>Nenhum agendamento encontrado para o mês selecionado.</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Selecione um mês para visualizar os agendamentos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <dialog id='reagendamodal'>
            <div id="containerReagenda"></div>
            <button class="fechar" id="fecharReagenda"><i class="fa-solid fa-xmark"></i></button>
        </dialog>
        <dialog id='cancelamodal'>
            <div id="containerCancela"></div>
            <button class="fechar" id="fecharCancela"><i class="fa-solid fa-xmark"></i></button>
        </dialog>
    </main>
    <?php
    include_once 'footer.php';
    ?>
    <script src="../js/menu.js"></script>
    <script>
        document.querySelectorAll('.reagendar').forEach(button => {
            button.addEventListener('click', function() {
                const id_agendamento = button.value;
                abrirModal(id_agendamento);
            });
        });
        const dialog = document.getElementById('reagendamodal');

        function abrirModal(id_agendamento) {
            fetch("modal_reagendar.php?id_agendamento=" + id_agendamento)
                .then((resposta) => {
                    if (resposta.ok) {
                        return resposta.text();
                    }
                })
                .then((dados) => {
                    document.getElementById("containerReagenda").innerHTML = dados;
                    dialog.show();
                    document.getElementById("modalReagendar").style.display = "block";
                });
        }
        document.querySelectorAll('.cancelar').forEach(button => {
            button.addEventListener('click', function() {
                const id_agendamento = button.value;
                abrirCancelModal(id_agendamento);
            });
        });
        const dialog2 = document.getElementById('cancelamodal');
        function abrirCancelModal(id_agendamento) {
            fetch("modal_cancelar.php?id_agendamento=" + id_agendamento)
                .then((resposta) => {
                    if (resposta.ok) {
                        return resposta.text();
                    }
                })
                .then((dados) => {
                    document.getElementById("containerCancela").innerHTML = dados;
                    dialog2.show();
                    document.getElementById("modalCancel").style.display = "block";
                });
        }
        document.getElementById('fecharReagenda').addEventListener('click', function() {
            document.getElementById('reagendamodal').close();
        });
        document.getElementById('fecharCancela').addEventListener('click', function() {
            document.getElementById('cancelamodal').close();
        });
    </script>

</body>

</html>