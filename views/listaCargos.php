<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos</title>
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
            <h1>Controle de Cargos</h1>
            <div class="table-container">
                <table class="tabelas" id="tabela-historico">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cargo</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $selectCargo = $conexao->prepare("SELECT * FROM cargo");
                        $selectCargo->execute();
                        if ($selectCargo->rowCount() > 0) {
                            while ($array = $selectCargo->fetch(PDO::FETCH_ASSOC)) {
                                $id_cargo = $array['id_cargo'];
                                $nome_cargo = $array['nome_cargo'];

                                echo "<tr>
                                        <td>$id_cargo</td>
                                        <td>$nome_cargo</td>
                                        <td><button value ='$id_cargo' id='cancelar' class='cancelar'>Excluir</button></td>
                                        <td><button value ='$id_cargo' id='reagendar' class='reagendar'>Alterar</button></td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Nenhum cargo encontrado.</td></tr>";
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
                const id_cargo = button.value;
                abrirModal(id_cargo);
            });
        });
        const dialog = document.getElementById('alteramodal');

        function abrirModal(id_cargo) {
            fetch("modal_alterarCargo.php?id_cargo=" + id_cargo)
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
                const id_cargo = button.value;
                abrirCancelModal(id_cargo);
            });
        });
        const dialog2 = document.getElementById('excluimodal');

        function abrirCancelModal(id_cargo) {
            fetch("modal_excluirCargo.php?id_cargo=" + id_cargo)
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