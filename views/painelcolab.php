<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Colaboradores</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/painelcolab.css">
    <link rel="stylesheet" href="../css/modais.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once '../admin/conexao.php';
    // Verifica se o nível de acesso necessário está na sessão
    $acessoNecessario = 1; // Nível de acesso que você deseja verificar

    // Verifica se o usuário possui os acessos na sessão
    // if (!isset($_SESSION['id_acessos']) || !in_array($acessoNecessario, $_SESSION['id_acessos'])) {
    //     include '../admin/semAcesso.php';
    //     exit();
    // }
    ?>
    <main>
        <section>

        <h1>Colaboradores</h1>

            <div class="container">
                <a id='cadastrarColab' href="./cadastrofuncionario.php">
                    <div class='colab-card' >
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Cadastrar colaborador</span>
                    </div>
                </a>
                <?php
                $pegando_funcionario = "SELECT * FROM funcionario inner join cargo on funcionario.id_cargo=cargo.id_cargo ORDER BY nome_funcionario";
                $preparando = $conexao->prepare($pegando_funcionario);
                $preparando->execute();
                while ($array = $preparando->fetch(PDO::FETCH_ASSOC)) {
                    $id_funcionario = $array['id_funcionario'];
                    $nome_funcionario = $array['nome_funcionario'];
                    $endereco = $array['endereco'];
                    $bairro = $array['bairro'];
                    $cidade = $array['cidade'];
                    $cep = $array['cep'];
                    $uf = $array['uf'];
                    $complemento = $array['complemento'];
                    $email = $array['email'];
                    $situacao = $array['situacao'];
                    $contato = $array['contato'];
                    $nome_cargo = $array['nome_cargo'];
                    $id_cargo = $array['id_cargo'];
                    $foto_funcionario = $array['img'];
                    $base64Imagem = base64_encode($foto_funcionario);
                ?>
                    <div class='colab-card'>
                        <p title="Edite o colaborador para modificar situação" class="situacaoCard"><?php echo $situacao == "1" ? "Ativo" : "Inativo"?></p>
                        <button title="Editar" id='btn-editar' class='btn-editar'
                            data-id='<?php echo $id_funcionario ?>'
                            data-nome='<?php echo $nome_funcionario ?>'
                            data-endereco='<?php echo $endereco ?>'
                            data-bairro='<?php echo $bairro ?>'
                            data-cidade='<?php echo $cidade ?>'
                            data-cep='<?php echo $cep ?>'
                            data-uf='<?php echo $uf ?>'
                            data-complemento='<?php echo $complemento ?>'
                            data-email='<?php echo $email ?>'
                            data-situacao='<?php echo $situacao ?>'
                            data-contato='<?php echo $contato ?>'
                            data-cargo='<?php echo $id_cargo ?>'
                            data-img= <?php echo $base64Imagem?>>
                            <!-- <i class="fa-solid fa-user-pen"></i> -->
                            <i class="fa-solid fa-user-gear"></i>
                            
                        </button>
                        <?php
                        /* Caso tenha imagem do funcionário irá aparecer */
                        if($foto_funcionario != '') {
                            echo "<div><img class='foto-colab' src='data:image/jpeg;base64,{$base64Imagem}'></div>";
                        } else {  /* Caso imagem esteja fazia */
                            echo "<div><img class='foto-colab' src='https://i.pinimg.com/236x/a8/da/22/a8da222be70a71e7858bf752065d5cc3.jpg' style='width: 100px;height: 100px;object-fit: cover;border-radius: 50%;'></div>";
                        }
                        ?>
                        <h2><?php echo $nome_funcionario ?></h2>
                        <p><?php echo $nome_cargo ?></p>
                    </div>
                <?php
                }
                ?>
            </div>

        </section>
        <dialog id="modal-colaborador">

            <!-- BNT Fechar modal -->
            <button class="fechar" id="fechar">
                <i class="fa-solid   fa-xmark"></i>
            </button>
            <form action="../admin/atualizarFuncionario.php" method="post" enctype="multipart/form-data">

                <!-- Modal -->
                <div class="top-modal">
                    <input type="hidden" id="id_funcionario" name="id_func">
                    <div id="container-foto">
                        <div class="quadro-foto">
                            <img id="img_funcionario" src="" alt="funcionario" class="img">
                        </div>
                        <div class="input-foto-wrapper">
                            <label for="foto_funcionario">Alterar foto</label>
                            <input type="file" name="foto_funcionario" id="foto_funcionario" accept="image/*">
                            <i class="fa-solid fa-user-pen" style="color: #f2f2f2;" id="icon"></i>
                        </div>
                    </div>
                    <div class="grupo-input">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome"><!--trazer do php-->
                    </div>

                </div>

                <div class="container-inputs">
                    <div class="infotres">
                        <div class="grupo-input">
                            <label for="contato">Contato</label>
                            <input type="text" name="contato" id="contato" class="tel">
                        </div>
                        <div class="grupo-input">
                            <label for="situ">Situação</label>
                            <select name="situacao" id="situ" class="situacao">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="grupo-input">
                            <label for="cargo">Cargo</label>
                            <select name="cargo" id="cargo" class="cargo">
                                <option value="">--- Cargo ---</option>
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
                    </div>
                    <div class="infodois">
                        <div class="grupo-input">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="email">
                        </div>
                        <div class="grupo-input">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" class="cep">
                        </div>
                    </div>
                    <div class="infodois">
                        <div class="grupo-input">
                            <label for="endereco">Endereço</label>
                            <input type="endereco" name="endereco" id="endereco" class="endereco">
                        </div>
                        <div class="grupo-input">
                            <label for="comp">Complemento</label>
                            <input type="text" name="complemento" id="comp" class="complemento">
                        </div>
                    </div>
                    <div class="infotres">
                        <div class="grupo-input">
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="bairro">
                        </div>
                        <div class="grupo-input">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="cidade">
                        </div>
                        <div class="grupo-input">
                            <label for="uf">UF</label>
                            <input type="text" name="uf" id="uf" class="uf">
                        </div>
                    </div>
                </div>

                <div class="bottom-form painColab">
                    <button type="button" id="cancelar">
                        Cancelar
                    </button>
                    <button type="submit" class="confirPainel">
                        Confirmar
                    </button>
                </div>
            </form>

        </dialog>
    </main>
    <?php
    include_once 'footer.php';
    ?>

    <script src="../js/painelColab.js"></script>

</body>

</html>