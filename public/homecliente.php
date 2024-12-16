<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vênnus Hair | Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/homecliente.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<?php
    include_once '../admin/conexao.php';
    include_once 'menuCli.php';
?>

<body>
    <main>
        <section>
            <div class="sideLeft">
                <h1>Vênnus Hair</h1>
                <div class="linha"></div>
                <div class="textWrapper">
                    <div>
                        <span>Boas vindas!</span>
                        <span>Agende o seu horário com</span>
                        <span>facilidade</span>
                    </div>
                    <a href="agendamentoCli.php">AGENDAR</a>
                </div>
            </div>
            <div class="sideIMG">
                <img src="../imgs/homeClie.png" alt="Imagem do salão">
            </div>
        </section>
    </main>
    <?php
    include_once '../views/footer.php';
    ?>
</body>

</html>