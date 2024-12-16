<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionário</title>
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
    ?>
    <main>
        <dialog id="avisos" class="aviso"></dialog>
        <section>
            <form id="form_recado" class="formulario" action="../admin/processar_CadFuncionario.php" method="post">
                <h1 class="titulo">Cadastro Funcionário</h1>
                <div class="form-wrapper">

                    <div class="grupo-inputs">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Digite o E-mail" required>
                    </div>


                    <div class="inputs-duplos">
                        <div class="grupo-inputs">
                            <label for="contato">Contato</label>
                            <input type="text" name="contato" id="contato" placeholder="(xx) xxxxx-xxxx" required>
                        </div>
                        <div class="grupo-inputs">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Digite a data de nascimento" required>
                        </div>
                    </div>

                    <div class="grupo-inputs">
                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" placeholder="Digite o número do CPF" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" id="cep" placeholder="Digite o número do CEP" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Digite o Endereço" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Digite seu bairro" required>
                    </div>

                    <div class="grupo-inputs">
                        <label for="cidade">Complemento:</label>
                        <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento da casa" required>
                    </div>

                    <div class="inputs-duplos">
                        <div class="grupo-inputs">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" placeholder="Digite sua Cidade" required>
                        </div>
                        <div class="grupo-inputs">
                            <label for="uf">UF</label>
                            <input type="text" name="uf" id="uf" placeholder="Digite o Estado" required>
                        </div>
                    </div>

                    <!-- Input Cargo -->
                    <div class="grupo-inputs">
                        <label class="cargo" for="cargo">Cargo:</label>
                        <select name="cargo" id="cargo">
                            <option value="0">--- Cargo ---</option>
                            <?php
                            $pegando_cargo = "SELECT * FROM cargo ORDER BY nome_cargo";
                            $preparando = $conexao->prepare($pegando_cargo);
                            $preparando->execute();
                            while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                                $id_cargo = $array['id_cargo'];
                                $nome_cargo = $array['nome_cargo'];
                            ?>
                                <option value="<?php echo $id_cargo; ?>">
                                    <?php echo $nome_cargo; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="grupo-inputs">
                        <label class="situacao" for="situacao">Situação:</label>
                        <select name="situacao" id="situacao">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                    <div class="grupo-inputs">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                    </div>
                </div>

                <div class="grupo-btns">
                    <button type="submit" class="btn-form enviar">
                        Cadastrar
                    </button>
                    <button type="reset" class="btn-form cancelar">
                        <a href="painelColab.php" style='text-decoration: none; color: #E61C62;'>Cancelar</a>
                    </button>
                </div>

                <dialog id="notifica" class="avisocep"></dialog>
            </form>
        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>
    <script src="../js/cadcliente.js"></script>
    <script src="../js/aviso_cadfunc.js"></script>
</body>

</html>