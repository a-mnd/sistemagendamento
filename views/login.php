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
    
</head> 

<body>
    <section>
        <div class="container">
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper active">
                    <div class="card-front">
                        <div class="center-wrap">
                            <div class="section">
                                <form id="loginForm" action="../admin/logar.php" method="post">
                                    <h4 class="tituloLogin">Conecte-se</h4>
                                    <div class="form-group">
                                        <input type="email" class="form-style" id="email" name="email" placeholder="Email">
                                        <i class="input-icon uil uil-at"></i>
                                    </div>
                                    <div class="form-group senha">
                                        <input type="password" id="password" name="password" class="form-style" placeholder="Password">
                                        <i class="input-icon uil uil-lock-alt"></i>
                                    </div>
                                    <button type="submit" class="btn btnE btnA">Entrar</button>
                                    <p class="alterarSenha">
                                        <a href="/views/altsenhalogin.html" class="link">Esqueceu sua senha?
                                        </a>
                                    </p>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <dialog id="modal-container-fechado" class="modal-container-fechado">
        <div class="modal-fechar">
            <p>Email ou senha invalidos.</p>
            <button class="fechar-data" onclick="fecharDialog()">OK</button>
        </div>
    </dialog>

    <script src="../js/login.js"></script> -->

</body>

</html>