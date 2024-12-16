<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Serviço</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <link rel="stylesheet" href="../css/avisos.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';

    /* Descomente essa parte para que a página tenha uma verificação por nível de acesso */
    // $acessoNecessario = [1, 2];

    // if (!isset($_SESSION['id_acessos']) || empty(array_intersect($acessoNecessario, $_SESSION['id_acessos']))) {
    //     // Redireciona para a página de acesso negado
    //     include '../admin/semAcesso.php';
    //     exit();
    // }
    ?>
    <main>
        <section>
            <div>
                <form  class="formulario" action="../admin/processar_servico.php" method="POST">
                    <h1 class="titulo">Cadastrar Serviços</h1>
                    <div class="form-wrapper">
                        <div class="grupo-inputs">
                            <label for="nomeservico">Nome do Serviço</label>
                            <input type="text" name="nomeservico" id="nomeservico">
                        </div>


                        <div class="grupo-inputs">
                            <label for="descricaoservico">Descrição do Serviço</label>
                            <textarea name="descricao" id="descricaoservico" cols="30" rows="10"></textarea>
                        </div>
                    </div>


                    <div class="grupo-inputs" id="input_preco">
                        <label for="preco">Preço</label>
                        <input type="text" name="preco" id="preco">
                    </div>

                    <div class="botao">
                        <button class="botaoalterar" type="submit">
                            Cadastrar Serviço
                        </button>
                    </div>
                    <div class="botao">
                        <button class="botaoVermais" type="submit">
                            <a href="listaServicos.php"> Ver mais Serviços</a>
                        </button>
                    </div>
            </div>
            </form>
            <div class="cadcargo">
                <form class="formulario" action="../admin/processar_cargo.php" method="POST">
                    <h1 class="titulo">Cadastrar Cargo</h1>
                    <div class="form-wrapper">
                        <div class="grupo-inputs">
                            <label for="cargo">Cargo</label>
                            <input type="text" name="cargo" id="cargo">
                        </div>
                    </div>

                    <div class="botao">
                        <button class="botaoalterar" type="submit">
                            Cadastrar cargo
                        </button>
                    </div>
                    <div class="botao">
                        <button class="botaoVermais" type="submit">
                            <a href="listaCargos.php"> Ver mais Cargos</a>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>