<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/agendamento.css">
    <link rel="stylesheet" href="../css/modais.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once "../admin/conexao.php";
    include_once 'menuCli.php';
    ?>
    <dialog id="avisos"></dialog>
    <main>
        <section>
            <h1>Agendamento</h1>
            <a id="vejaHistorico" href="./historico.php">Já tem um agendamento? <u>Veja o histórico</u></a>

            <div>
                <select class="mesSelecionado" name="mesSelecionado" id="mesSelecionado" onchange="mudarMes()">
                    <option value="0">Janeiro</option>
                    <option value="1">Fevereiro</option>
                    <option value="2">Março</option>
                    <option value="3">Abril</option>
                    <option value="4">Maio</option>
                    <option value="5">Junho</option>
                    <option value="6">Julho</option>
                    <option value="7">Agosto</option>
                    <option value="8">Setembro</option>
                    <option value="9">Outubro</option>
                    <option value="10">Novembro</option>
                    <option value="11">Dezembro</option>
                </select>

            </div>

            <div class="containerCalendario">
                <div class="calendario" id="calendario">
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
                <div class="legenda">
                    <div class="textolegenda">
                        <div class="fechado"></div>
                        <div class="texto">Fechado</div>
                    </div>
                    <div class="textolegenda">
                        <div class="esgotado"></div>
                        <div class="texto">Esgotado</div>
                    </div>
                    <div class="textolegenda">
                        <div class="selecionado"></div>
                        <div class="texto">Selecionado</div>
                    </div>
                </div>
                <button onclick="abrirModal()" class="escolhadata" id="escolhadata">Escolha uma data</button>
            </div>

            <dialog id="agendamentoDialog"><!--style="display:none;-->
                <div class="divFlex">
                    <form id="agendamentoForm" method="post">
                        <div class="data">
                            <input type="text" name="dia" class="dia" id="diaSelecionado" readonly>
                            <div class="mes">
                                <p>de</p>
                                <input type="text" name="mes" id="mesSelecionadoTexto" readonly>
                            </div>
                        </div>
                        <div class="container-inputs">
                            <div class="grupo-input">
                                <label for="nome">Nome</label>
                                <input type="text" class="nome" name="nome" id="nome">
                            </div>
                            <div class="infodois">
                                <div class="grupo-input">
                                    <label for="contato">Número para contato</label>
                                    <input type="text" name="contato" id="contato" class="tel">
                                </div>
                                <div class="grupo-input">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" class="tel">
                                </div>
                            </div>
                            <div class="infodois">
                                <div class="grupo-input">
                                    <label for="func">Profissional</label>
                                    <select name="profissional" id="func" class="funcionario">
                                        <option value=""></option>
                                        <?php
                                        $pegando_funcionario = "SELECT * FROM funcionario ORDER BY nome_funcionario ";
                                        $preparar = $conexao->prepare($pegando_funcionario);
                                        $preparar->execute();
                                        while ($array = $preparar->fetch(PDO::FETCH_ASSOC)) {
                                            $id_funcionario = $array['id_funcionario'];
                                            $nome_funcionario = $array['nome_funcionario'];
                                            $situacao = $array['situacao'];

                                            if ($situacao == "1") {
                                        ?>
                                                <option value="<?= $id_funcionario ?>"> <?= $nome_funcionario ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="grupo-input">
                                    <label for="serv">Procedimento</label>
                                    <select name="servico" id="serv" class="servicos">
                                        <option value=""></option>
                                        <?php
                                        $pegando_servicos = "SELECT * FROM servicos ORDER BY nome_servico";
                                        $preparando = $conexao->prepare($pegando_servicos);
                                        $preparando->execute();
                                        while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                                            $id_servico = $array['id_servico'];
                                            $nome_servico = $array['nome_servico'];
                                        ?>
                                            <option value="<?= $id_servico ?>">
                                                <?= $nome_servico ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bottom-form horario">
                            <div class="grupo-input">
                                <select name="hora" id="hora" class="horario">
                                </select>
                            </div>
                            <button type="submit" id="confirmar" class="confirmar">Agendar</button>
                        </div>
                        <button type="button" class="fechar" id="fechar" onclick="fecharModal()"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                </div>
            </dialog>
            <?php
            // echo "<h2> $dataAgendamento </h2>" ;
            ?>
        </section>
    </main>
    <script src="../js/agendamento.js"></script>
    <script>
        const form_agendamento = document.getElementById('agendamentoForm');
        const btnAgendar = document.getElementById('confirmar');
        const avisos = document.getElementById('avisos');

        form_agendamento.addEventListener('submit', (e) => {
            e.preventDefault();
            btnAgendar.innerHTML = "Aguarde" + '<i class="fa-solid fa-spinner fa-spin"></i>';
            btnAgendar.style.pointerEvents = "none";
            let dados_form = new FormData(form_agendamento);
            fetch("../admin/processar_agendamento.php", {
                    body: dados_form,
                    method: 'POST'
                })
                .then((resposta) => {
                    if (resposta.ok) {
                        return resposta.text()
                    }
                })
                .then((dados) => {
                    avisos.innerHTML = "<i class='fa-regular fa-calendar-check fa-bounce'></i>" + dados;
                    avisos.open = true;
                    setTimeout(() => {
                        avisos.open = false;
                    }, 3000);
                    // alert(dados);
                    fecharModal();
                    btnAgendar.style.pointerEvents = "auto";
                    btnAgendar.innerHTML = "Agendar";
                })
        });
    </script>
    <?php
    include_once '../views/footer.php';
    ?>
</body>

</html>