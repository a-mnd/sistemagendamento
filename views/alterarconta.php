<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Conta</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    ?>
    <main>
        <section>
            <form class="formulario">
                <h1 class="titulo">Alterar Conta</h1>
                <div class="form-wrapper" id="alt_conta">
                    <h2 class="sub_titulo">Deseja apagar sua conta?</h2>
                    <div class="form_conta">
                        <input type="radio" name="nao" id="sim">
                        <label for="sim">Sim</label>
                    </div>
                    <div class="form_conta">
                        <input type="radio" name="nao" id="nao">
                        <label for="nao">Não</label>
                    </div>
                    <div class="grupo-inputs" id="input_confsenha">
                        <label for="confirmarsenha">Confirmar senha para continuar:</label>
                        <input type="text" name="confirmarsenha" id="confirmarsenha" required>
                    </div>
                </div>

                <div class="botao">
                    <button type="submit" class="botaoalterar">Alterar
                    </button>
                </div>
            </form>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>

</body>

</html>