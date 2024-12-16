<!doctype html>
<html lang="pt-br">

<head>
    <title>Sistema de Agendamento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/base.css"> -->
    <link rel="stylesheet" href="../css/login.css">
    <!-- <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon"> -->
    <!-- <link rel="stylesheet" href="../css/base.css"> -->

</head>
<body>
    <?php
    include_once "../admin/conexao.php";
    ?>
    <section>
        <div class="container">
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper active">
                    <div class="card-front">
                        <div class="center-wrap">
                            <div class="section">
                                <form id="loginForm" action="../admin/processaCli.php" method="post">
                                    <h4 class="tituloLogin">Conecte-se</h4>
                                    <p>Entre e consiga acesso a mais opções.</p>
                                    <hr>
                                    <ul>
                                        <li class="icones">
                                            <i class="fa-solid fa-clipboard-list"></i>
                                            <span class="plinks">Reagendar</span>
                                        </li>
                                        <li class="icones">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <span class="plinks">Histórico de
                                                seus agendamentos</span>
                                        </li>
                                        <li class="icones">
                                            <i class="fa-solid fa-calendar-xmark"></i>
                                            <span class="plinks">Cancelar</span>
                                        </li>
                                    </ul>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Contato</label>
                                        <input type="text" class="form-style" id="contato" name="contato" placeholder="(00) 00000-0000">
                                    </div>
                                    <button type="submit" class="btn btnE btnA">Entrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>