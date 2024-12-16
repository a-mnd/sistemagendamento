<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desenvolvimento de Soluções Web</title>
</head>
<?php
include_once '../admin/conexao.php';

$selectUser = $conexao->prepare("SELECT * FROM agendamento ORDER BY id_agendamento DESC LIMIT 1");
$selectUser->execute();

$ultimoRegistro = $selectUser->fetch(PDO::FETCH_ASSOC);
?>
<body style="font-family: Arial, sans-serif;margin: 0;padding: 0;background-color: #f4f4f4;">
    <div style="max-width: 100%;margin: 15px auto;background-color: #ffffff;padding: 15px;border-radius: 8px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="padding: 15px;">
            <?php
            if($ultimoRegistro) {
                $nome = $ultimoRegistro['nome_cliente'];
            ?>
            <h2 style="color: #333333;">Olá, <?= $nome?>! Tudo bem?</h2>
            <?php } else {?>
            <h2 style="color: #333333;">Olá, Usuário</h2>
            <?php }?>
            <a href="">Valide seu e-mail</a>
            <img src="cid::logo" alt="">
            <a href="<?php echo $linkValidacao?>">Acesse esse link para validar-se</a>
        </div>
    </div>
</body>
</html>