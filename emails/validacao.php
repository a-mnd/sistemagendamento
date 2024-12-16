<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação</title>
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
    <style>
        /*TELAS GERAIS*/
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: scroll;
 
        }
 
        header {
            margin-bottom: 20px;
 
        }
 
        main {
            margin-bottom: 20px;
 
        }
 
        footer {
            margin-top: 20px;
 
        }
 
 
        /*CSS - MENU */
        .menu {
            border: 2px solid #262E5D;
            background-color: #262E5D;
        }
 
        /*CSS - LOGO*/
        .logo {
            color: white;
            display: flex;
            flex-direction: row;
        }
 
        h1 {
            font-size: 30px;
            text-align: center;
        }
 
        .texto {
            font-size: 30px;
            align-content: center;
            padding: 10px;
        }
 
        .pink {
            color: #E61C62;
            font-weight: bold;
        }
 
        button {
            background-color: white;
            color: #E61C62;
            border-radius: 7px;
            border-color: #E61C62;
            cursor: pointer;
            align-items: center;
            padding: 10px 15px;
            margin: 10px;
            font-size: 12px;
        }
 
        .cinza {
            flex-direction: column;
            background-color: #EEEDED;
            height: 30vh;
        }
 
        .final {
            display: flex;
            border: 2px solid #262E5D;
            background-color: #262E5D;
            color: gray;
            text-align: center;
            align-items: center;
            height: 100px;
            flex-direction: column;
            justify-content: space-around;
        }
 
        .iconep,
        .icones,
        .iconet {
            align-items: center;
            text-align: center;
            background-color: white;
            color: #E61C62;
            cursor: pointer;
            border: 2px solid black;
            border-radius: 7px;
            width: 45%;
            justify-content: space-around;
            margin: 10px;
            flex-direction: row;
 
        }
 
        /*APLICADO RESPONSIVIDADE - TELAS MENORES*/
        @media (max-width: 768px) {
 
            .menu,
            .final {
                flex-direction: column;
                align-items: center;
            }
 
            .logo {
                font-size: 24px;
            }
 
            h1 {
                font-size: 24px;
            }
 
            .texto {
                font-size: 17px;
                align-items: center;
                text-align: center;
 
            }
 
 
            .iconep,
            .icones,
            .iconet {
                flex-direction: column;
                gap: 10px;
                height: auto;
                border: 2px solid black;
                border-radius: 7px;
 
            }
 
            button {
                font-size: 14px;
                justify-content: center;
            }
 
            .cinza {
                height: 23vw;
                padding: 20px;
            }
        }
 
        /*APLICADO RESPONSIVIDADE - PEQUENA*/
        @media (max-width: 400px) {
 
            .logo {
                font-size: 20px;
            }
 
            h1 {
                font-size: 20px;
            }
 
            .texto {
                font-size: 12px;
                align-items: center;
                text-align: center;
 
            }
 
            button {
                font-size: 12px;
                justify-content: center;
            }
 
            .cinza {
                height: auto;
            }
        }
    </style>
</head>

<?php
include_once '../admin/conexao.php';

$selectUser = $conexao->prepare("SELECT * FROM agendamento ORDER BY id_agendamento DESC LIMIT 1");
$selectUser->execute();

$ultimoRegistro = $selectUser->fetch(PDO::FETCH_ASSOC);
?>
 
<body>
    <!--MENU-->
    <header>
        <div class="menu">
            <!--LOGO-->
            <ul>
                <li class="logo">LO<br>GO</li>
            </ul>
        </div>
        <!--TEXTO DE VALIDAÇÃO DE E-MAIL-->
        <main>
            <section>
                <h1>Validação do Usuário</h1>
                <hr>
                <div id="texto" class="texto">
                <?php
                if($ultimoRegistro) {
                $nome = $ultimoRegistro['nome_cliente'];
                ?>
                    <p>Olá, <span class="pink">
                        <?= $nome?>
                        </span>! Tudo bom?</p>
                <?php } else {?>
                    <p>Olá, <span class="pink">
                        <?= $nome?>
                        </span>! Tudo bom?</p>
                <?php }?>
 
                    <p>Ficamos muito felizes em saber que você realizou um agendamento conosco!🎉</p>
 
                    <p>Estamos enviando este e-mail para que você possa confirmar os seus dados e, assim, <span
                            class="pink">habilitar mais opções exclusivas.</span></p>
                </div>
 
            </section>
 
            <!--ICONES TELA-->
            <div class="iconep">
                <p><b>Reagendar</b></p>
                <i class="fa-solid fa-clipboard-list" style="color: #E61C62;"></i>
            </div>
 
            <div class="icones">
                <p><b>Histórico de <br>
                        Seus Agendamentos</b></p>
                <i class="fa-solid fa-clock-rotate-left" style="color: #E61C62;"></i>
            </div>
 
            <div class="iconet">
                <p><b>Cancelar</b></p>
                <i class="fa-solid fa-calendar-xmark" style="color: #E61C62;"></i>
            </div>
            </div>
        </main>
        <!--BUTTON DE "CLIQUE AQUI PARA VALIDAÇÃO"-->
        <footer>
            <div class="cinza">
                <button><a style="text-decoration: none; color: #E61C62;" href="<?php echo $linkValidacao?>">Clique aqui para validação</a></button>
            </div>
            <div class="final">
                <p>Equipe Vênnus Hair</p>
            </div>
        </footer>
    </header>
</body>
 
</html>