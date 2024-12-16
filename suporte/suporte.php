<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base</title>
    <link rel="stylesheet" href="../css/suporte.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    ?>
    <main>
        <section id="chatbot">
            <h1>Suporte</h1>
            <ul class="chatbox">
                <li class="chat out">
                    <span class="fa-regular fa-face-smile"></span>
                    <p>Olá, como posso te ajudar?</p>
                </li>
                <li class="chat in">
                    <p>Agendamento</p>
                </li>
            </ul>
            <form id="form" class="chat-input">
                <input type="text" name="falar" id="falar" placeholder="Digite sua mensagem" required>
                <button type="submit" id="enviar" class="fa-regular fa-paper-plane"></button>
            </form>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>
    <script src="/js/suporte.js"></script>
</body>

</html>