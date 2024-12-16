<header>
    <?php
    session_start();
    // print_r($_SESSION);
    ?>
    <nav id="menu-desktop">
        <ul>
            <li class="icones">
                <a href="./homecliente.php">
                    <i class="fa-solid fa-house"></i>
                    <span class="plinks">Home</span>
                </a>
            </li>
            <li class="icones">
                <a href="./agendamentoCli.php">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span class="plinks">Agendamento</span>
                </a>
            </li>
            <li class="icones">
                <a href="historico.php">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="plinks">Histórico</span>
                </a>
            </li>
        </ul>
        <ul>
            <li class="logo"><a href="homecliente.php">LO<br>GO</a></li>
        </ul>
        <ul class="usuario">
            <li>
                <?php
                if (isset($_SESSION['nome_cliente'])) {
                    $partesNome = explode(' ', htmlspecialchars($_SESSION['nome_cliente']));

                    if (isset($partesNome[1]) && $partesNome[1] != '') {
                        echo "<a class='user_name' href='../admin/logoutCli.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . " " . $partesNome[1] . "</span></a>";
                    } else {
                        echo "<a class='user_name' href='../admin/logoutCli.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . "</span></a>";
                    }
                } else {
                    echo "<a href='login.php'>Entrar</a>";
                }
                ?>
            </li>

            <?php
            if(isset($_SESSION['nome_cliente'])) {
            ?>
            <li class="icones">
                <a href="../admin/logoutCli.php">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="plinks">Sair</span>
                </a>
            </li>
            <?php }?>

        </ul>
    </nav>

    <div id="header-mobile" class="visualizacao-menu">
        <a href="./homecliente.php"><img src="../imgs/logo.png" alt="Logo da empresa"></a>
        <i id="menu-hamburguer" class="fa fa-bars"></i>
    </div>

    <nav id="menu-mobile" class="visualizacao-menu">
        <div class="top-header">
            <a href="./homecliente.php"><img src="../imgs/logo.png" alt="Logo da empresa"></a>
            <img id="close-button" src="../imgs/close-icon-mobile.svg" alt="ícone de fechar o menu">
        </div>
        <div class="lista-menu-mobile">
            <a href="./homecliente.php">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <a href="./agendamentoCli.php">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Calendário</span>
            </a>
            <a href="./historico.php">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Histórico</span>
            </a>
        </div>
        <?php
        if (isset($_SESSION['nome_cliente'])) {
            $partesNome = explode(' ', htmlspecialchars($_SESSION['nome_cliente']));

            if (isset($partesNome[1]) && $partesNome[1] != '') {
                echo "<a id='nome_cliente-menu' href='../admin/logoutCli.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . " " . $partesNome[1] . "</span></a>";
            } else {
                echo "<a id='nome_cliente-menu' href='../admin/logoutCli.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . "</span></a>";
            }
        } else {
            echo "<a id='nome_cliente-menu' href='./login.php'>Entrar</a>";
        }
        ?>
    </nav>

    <script src="../js/menu.js"></script>
</header>