<header>
    <?php
    /* Inicia uma sessão */
    session_start();
    ?>
    <nav id="menu-desktop">
        <ul>
            <?php
            if (isset($_SESSION['nome']) && array_intersect([1, 2, 3], $_SESSION['id_acessos'])) {
            ?>
                <li class="icones">
                    <a href="./homeEstab.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="plinks">Home</span>
                    </a>
                </li>
                <li class="icones">
                    <a href="./agendamento.php">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="plinks">Agendamento</span>
                    </a>
                </li>
                <li class="icones">
                    <a href="./NewhistoricoAgend.php">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <span class="plinks">Histórico</span>
                    </a>
                </li>
            <?php } ?>

            <?php
            if (isset($_SESSION['nome']) && array_intersect([1, 2], $_SESSION['id_acessos'])) {
            ?>
            <li class="icones">
                <div id="linhaMenu"></div>
            </li>
            <?php }?>


            <?php
            if (isset($_SESSION['nome']) && array_intersect([1, 2], $_SESSION['id_acessos'])) {
            ?>
                <li class="icones">
                    <a href="relatorio.php">
                        <i class="fa-solid fa-chart-column"></i>
                        <span class="plinks">Relatório</span>
                    </a>
                </li>
            <?php } ?>

            <?php
            if (isset($_SESSION['nome']) && array_intersect([1, 2], $_SESSION['id_acessos'])) {
            ?>
                <li class="icones">
                    <a href="painelColab.php">
                        <i class="fa-solid fa-user-tie"></i>
                        <!-- <i class="fa-solid fa-users"></i> -->
                        <span class="plinks">Colaborador</span>
                    </a>
                </li>
            <?php } ?>


            <?php
            if (isset($_SESSION['nome']) && array_intersect([1, 2], $_SESSION['id_acessos'])) {
            ?>
                <li class="icones">
                    <a href="cadastroservico.php">
                        <i class="fa-solid fa-briefcase"></i>
                        <!-- <i class="fa-solid fa-users"></i> -->
                        <span class="plinks">Serviços</span>
                    </a>
                </li>
            <?php } ?>

            <?php
            if (isset($_SESSION['nome']) && array_intersect([1], $_SESSION['id_acessos'])) {
                // echo "tem acesso";
            ?>
                <li class="icones">
                    <a href="niveisAcesso.php">
                        <i class="fa-solid fa-user-lock"></i>
                        <!-- <i class="fa-solid fa-users"></i> -->
                        <span class="plinks">Acesso</span>
                    </a>
                </li>

            <?php } ?>
        </ul>
        <ul>
            <li class="logo">LO<br>GO</li>
        </ul>
        <ul class="usuario">
            <li>
                <?php
                // Caso o usuário tiver esses requisitos na sessão: Nome e Algum nível de acesso
                if (isset($_SESSION['nome']) && array_intersect([1, 2, 3], $_SESSION['id_acessos'])) {
                    $partesNome = explode(' ', htmlspecialchars($_SESSION['nome']));

                    if (isset($partesNome[1]) && $partesNome[1] != '') {
                        echo "<a class='user_name' href='../admin/logout.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . " " . $partesNome[1] . "</span></a>";
                    } else {
                        echo "<a class='user_name' href='../admin/logout.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . "</span></a>";
                    }

                    $id_func_session = $_SESSION['id_funcionario'];
                } else {
                    // echo header('location: login.php');
                    // Para utilizar as páginas de funcionário é necessário estar logado. Caso isso esteja atrapalhando na produção do projeto de alguma forma, utilize a linha abaixo para retirar a exigência de login.
                    echo "<a href='login.php'>Logar</a>";
                }
                ?>
            </li>

            <?php
            if(isset($_SESSION['nome']) && array_intersect([1,2,3])){
            ?>
            <li class="icones">
                <a href="./alterarsenha.php">
                    <i class="fa-solid fa-gear"></i>
                    <span class="plinks">Alterar senha</span>
                </a>
            </li>
            <?php }?>
        </ul>

    </nav>

    <div id="header-mobile" class="visualizacao-menu">
        <img src="../imgs/logo.png" alt="Logo da empresa">
        <i id="menu-hamburguer" class="fa fa-bars"></i>
    </div>

    <!-- Nav mobile -->
    <nav id="menu-mobile" class="visualizacao-menu">
        <div class="top-header">
            <a href="#"><img src="../imgs/logo.png" alt="Logo da empresa"></a>
            <img id="close-button" src="../imgs/close-icon-mobile.svg" alt="ícone de fechar o menu">
        </div>
        <div class="lista-menu-mobile">
            <a href="../views/homecliente.php">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-user"></i>
                <span>Cadastro</span>
            </a>
            <a href="#">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Calendário</span>
            </a>
            <a href="../views/NewhistoricoAgend.php">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Histórico</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Relatório</span>
            </a>
            <a href="./alterarsenha.php">
                <i class="fa-solid fa-gear"></i>
                <span>Alterar senha</span>
            </a>
        </div>
        <?php
        if (isset($_SESSION['nome'])) {
            $partesNome = explode(' ', htmlspecialchars($_SESSION['nome']));

            if (isset($partesNome[1]) && $partesNome[1] != '') {
                echo "<a id='nome_cliente-menu' href='../admin/logout.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . " " . $partesNome[1] . "</span></a>";
            } else {
                // Alterar para
                // header('location: location.php');
                echo "<a id='nome_cliente-menu' href='../admin/logout.php' title='Sair da conta'>Olá, <span>" . $partesNome[0] . "</span></a>";
            }
        } else {
            echo "<a id='nome_cliente-menu' href='login.php'>Logar</a>";
        }
        ?>
    </nav>

    <script src="../js/menu.js"></script>
</header>