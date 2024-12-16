<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/tabelas.css">
    <link rel="stylesheet" href="../css/modais.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once "../admin/conexao.php";
    include_once 'menu.php';
    ?>
    <main>
        <section>
            <h1>Controle de Serviços</h1>
            <div class="table-container">
                <table class="tabelas" id="tabela-historico">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Serviço</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selectServicos = $conexao->prepare("SELECT * FROM servicos");
                        $selectServicos->execute();
                        if ($selectServicos->rowCount() > 0) {
                            while ($array = $selectServicos->fetch(PDO::FETCH_ASSOC)) {
                                $id_servico = $array['id_servico'];
                                $nome_servico = $array['nome_servico'];
                                $descricao = $array['descricao_servico'];
                                $valor = $array['valor'];

                                echo "<tr>
                                        <td>$id_servico</td>
                                        <td>$nome_servico</td>
                                        <td>$descricao</td>
                                        <td>R$" . $valor . "</td>
                                        <td><button value ='$id_servico' id='cancelar' class='cancelar'>Excluir</button></td>
                                        <td><button value ='$id_servico' id='reagendar' class='reagendar'>Alterar</button></td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Nenhum servicço encontrado.</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>

        </section>
        <dialog id='alteramodal'>
            <div id="containerAlterar"></div>
            <button class="fechar" id="fecharAltera"><i class="fa-solid fa-xmark"></i></button>
        </dialog>
        <dialog id='excluimodal'>
            <div id="containerExcluir"></div>
            <button class="fechar" id="fecharExclui"><i class="fa-solid fa-xmark"></i></button>
        </dialog>
    </main>
    <?php
    include_once 'footer.php';
    ?>
    <script>
        document.querySelectorAll('.reagendar').forEach(button => {
            button.addEventListener('click', function() {
                const id_servico = button.value;
                abrirModal(id_servico);
            });
        });
        const dialog = document.getElementById('alteramodal');

        function abrirModal(id_servico) {
            fetch("modal_alterarServico.php?id_servico=" + id_servico)
                .then((resposta) => {
                    if (resposta.ok) {
                        return resposta.text();
                    }
                })
                .then((dados) => {
                    document.getElementById("containerAlterar").innerHTML = dados;
                    dialog.show();
                    document.getElementById("modalAlterar").style.display = "block";
                });
        }
        document.querySelectorAll('.cancelar').forEach(button => {
            button.addEventListener('click', function() {
                const id_servico = button.value;
                abrirCancelModal(id_servico);
            });
        });
        const dialog2 = document.getElementById('excluimodal');

        function abrirCancelModal(id_servico) {
            fetch("modal_excluirServico.php?id_servico=" + id_servico)
                .then((resposta) => {
                    if (resposta.ok) {
                        return resposta.text();
                    }
                })
                .then((dados) => {
                    document.getElementById("containerExcluir").innerHTML = dados;
                    dialog2.show();
                    document.getElementById("modalExcluir").style.display = "block";
                });
        }
        document.getElementById('fecharAltera').addEventListener('click', function() {
            document.getElementById('alteramodal').close();
        });
        document.getElementById('fecharExclui').addEventListener('click', function() {
            document.getElementById('excluimodal').close();
        });

    </script>
</body>

</html>