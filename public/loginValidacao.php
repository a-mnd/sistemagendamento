<!doctype html>
<html lang="pt-br">

<head>
    <title>Vlidação de usuário | Vênnus Hair</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/base.css"> -->
    <link rel="stylesheet" href="../css/login.css">
    <style>
        dialog {
            z-index: 1000;
            width: 250px;
            height: 80px;
            background-color: #262E5D;
            border-radius: 10px;
            /* position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(50%, -50%); */
            border: 3px solid #E61C62;

            text-align: center;
            margin: 20px auto 0;
            font-family: Poppins;
            color: #ffff;
        }
    </style>
</head>
    <?php
    include_once "../admin/conexao.php";
    ?>

<body>
    <dialog id="avisos"></dialog>
    <section>
        <div class="container">
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper active">
                    <div class="card-front">
                        <div class="center-wrap">
                            <div class="section">
                                <form id="loginForm" action="../emails/validaremail.php" method="post">
                                    <input type="hidden" value="<?= $_GET['cli'] ?>" name="cod_validacao">
                                    <h4 class="tituloLogin">Validação de usuário</h4>
                                    <p>Insira seu número de telefone e e-mail</p>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Contato</label>
                                        <input type="text" class="form-style" id="contato" name="contato" placeholder="(00) 00000-0000">
                                    </div>
                                    <div class="form-group">
                                        <label for="">E-mail</label>
                                        <input type="email" class="form-style" id="email" name="email" placeholder="seu.email@exemplo.com">
                                    </div>
                                    <button type="submit" class="btn btnE btnA">Validar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/modalCli.js"></script>

</body>

</html>