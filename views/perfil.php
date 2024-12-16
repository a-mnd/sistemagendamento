<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Cliente</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once '../admin/conexao.php';
    //selecionado todas as informações do banco
    $idlogado = 1;
    $select = $conexao->prepare('SELECT * FROM cliente where id_cliente = :id');
    $select->bindParam(':id', $idlogado);
    $select->execute();
    $res = $select->fetch(PDO::FETCH_ASSOC);

    ?>
    <main>
        <section>
            <form class="formulario" method="post" action="../admin/processar_perfil.php">
                <h1 class="titulo">Perfil</h1>
                <!-- Campo oculto para o id do cliente -->
                <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $res['id_cliente'] ?>">
                <div class="form-wrapper">
                    <div class="grupo-inputs">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_cliente" id="nome_cliente" placeholder="Digite seu nome" value="<?php echo $res['nome_cliente'] ?>" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Digite o E-mail" value="<?php echo $res['email'] ?>" required>
                    </div>

                    <div class="inputs-duplos">
                        <div class="grupo-inputs">
                            <label for="contato">Contato</label>
                            <input type="text" name="contato" id="contato" placeholder="(xx) xxxxx-xxxx" value="<?php echo $res['contato'] ?>" required>
                        </div>
                        <div class="grupo-inputs">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Digite a data de nascimento" value="<?php echo $res['data_nascimento'] ?>" required>
                        </div>
                    </div>

                    
                    <div class="grupo-inputs">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" placeholder="Digite o número do CPF" value="<?php echo $res['cpf'] ?>" required>
                    </div>                 

                    <div class="grupo-inputs">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Digite o Endereço" value="<?php echo $res['endereco'] ?>" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="cep">CEP</label>
                        <input type="number" name="cep" id="cep" onkeyup="limparDados()" placeholder="Digite seu CEP" value="<?php echo $res['cep'] ?>">
                    </div>


                    <div class="grupo-inputs">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Digite seu bairro"  value="<?php echo $res['bairro'] ?>" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="cidade">Complemento</label>
                        <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento da casa" value="<?php echo $res['complemento'] ?>" required>
                    </div>

                    <div class="inputs-duplos">
                        <div class="grupo-inputs">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" placeholder="Digite sua Cidade" value="<?php echo $res['cidade'] ?>" required>
                        </div>
                        <div class="grupo-inputs">
                            <label for="uf">UF</label>
                            <input type="text" name="uf" id="uf" placeholder="Digite o Estado" value="<?php echo $res['uf'] ?>" required>
                        </div>
                    </div>

                    <div class="grupo-inputs">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" value="<?php echo $res['senha'] ?>" required>
                    </div>

                </div>
                <div class="grupo-btns">
                    <button type="submit" class="btn-form enviar">
                        Atualizar
                    </button>
                    <button type="reset" class="btn-form cancelar">
                        Cancelar
                    </button>
                </div>

                <dialog id="notifica"></dialog>
            </form>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>

    <script src="../js/menu.js"></script>
    <script src="../js/cadcliente.js"></script>
</body>

</html>