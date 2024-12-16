<?php //session_start();?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <link rel="stylesheet" href="../css/avisos.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once "../admin/conexao.php";
    if (isset($_SESSION['nome'])) {
       //echo "<h4>".$_SESSION['nome']."</h4>";
        $id_funcionario = $_SESSION['id_funcionario'];
    }

    $select = $conexao->prepare('SELECT senha FROM funcionario WHERE id_funcionario = :id_funcionario');
    $select->bindParam(':id_funcionario', $id_senha);
    $select->execute();
    $res = $select->fetch(PDO::FETCH_ASSOC);
    
    ?>
    <main>
        <section>
         <dialog id="avisos" class="aviso"></dialog>
            <form id="form_recado" class="formulario" action="../admin/processar_senha.php" method="POST">
                 <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?= $id_funcionario?>">
                <h1 class="titulo">Alterar Senha</h1>
                <div class="form-wrapper" id="alt_senha">
                    <div class="grupo-inputs">
                        <label for="senha">Senha Atual:</label>
                        <input type="password" name="senha" id="senha" required value="<?php //$res['senha'] 
                                                                                        ?>">
                    </div>
                    <div class="grupo-inputs">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" name="nova_senha" id="nova_senha" required value="<?php //$res['nova_senha'] 
                                                                                                    ?>">
                    </div>
                    <div class="grupo-inputs">
                        <label for="confirmar_senha">Confirmar nova senha:</label>
                        <input type="password" name="confirmar_senha" required value="<?php //$res['confirmar_senha'] 
                                                                                        ?>">
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
    <script src="../js/avisos.js"></script>
</body>

</html>