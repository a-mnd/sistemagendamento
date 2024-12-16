<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Níveis de acesso</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/tabelas.css">
    <link rel="stylesheet" href="../css/modalAlerta.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    include_once '../admin/conexao.php';

    // $acessoNecessario = 1;

    // // Verifica se o usuário possui os acessos na sessão
    // if (!isset($_SESSION['id_acessos']) || !in_array($acessoNecessario, $_SESSION['id_acessos'])) {
    //     // Redireciona ou exibe uma mensagem de erro
    //     include '../admin/semAcesso.php';
    //     exit();
    // }

    /* Adiciona dados a variavel pelo método post, contendo uma condição padrão ' '(null) caso não tenha nungum valor na requisição */
    $cargoId = $_POST['cargo'] ?? '';
    $nomeFuncionario = $_POST['nomeFuncionario'] ?? '';

    /* Construção da query para selecionar nome do funcionario e id_cargo */
    /* Selecionamos toda a tabela funcionario fazendo uma junção com a tabela cargo onde será buscado pelos parámetros nome_funcionario ou id_cargo e ordenando pelo nome do funcionario */
    $query = "SELECT * FROM funcionario 
              INNER JOIN cargo ON funcionario.id_cargo = cargo.id_cargo 
              WHERE (:cargoId = '' OR cargo.id_cargo = :cargoId)
              AND (:nomeFuncionario = '' OR nome_funcionario LIKE :nomeFuncionario)
              ORDER BY nome_funcionario";
    
    $stmt = $conexao->prepare($query);
    /* Adicionando um valor */
    $stmt->bindValue(':cargoId', $cargoId);
    /* Adicionando um novo valor */
    /* O % (porcentagem) irá trabalhar junto com o LIKE do sql para fazer um consulta que não necessáriamente irá puxar com exatidão todo o nome do funcionário */
    $stmt->bindValue(':nomeFuncionario', "%$nomeFuncionario%");
    $stmt->execute();

    ?>

    <main>
        <section>
            <h1>Níveis de Acesso</h1>
            <form action="#" method="POST" class="input-select" id="form-filtros">
                <!-- Campo de pesquisa pelo nome do funcionário -->
                <input type="text" name="nomeFuncionario" placeholder="Pesquisar nome"
                    value="<?php echo htmlspecialchars($nomeFuncionario) ?>" oninput="delayedSubmit()"> <!-- Adicionado uma função ao oniput que será manipulada no js externo -->

                <!-- Select para selecionar o cargo -->
                <select name="cargo" id="cargo" onchange="document.getElementById('form-filtros').submit()">
                    <option value="">Cargo</option>
                    <?php
                    $pegando_cargo = $conexao->query("SELECT * FROM cargo ORDER BY nome_cargo");
                    while ($array = $pegando_cargo->fetch(PDO::FETCH_ASSOC)) {
                        $id_cargo = $array['id_cargo'];
                        $nome_cargo = $array['nome_cargo'];
                        $selected = ($cargoId == $id_cargo) ? 'selected' : '';
                        echo "<option value=\"$id_cargo\" $selected>$nome_cargo</option>";
                    }
                    ?>
                </select>
            </form>

            <div class="table-container">
                <table class="tabelas" id="tabela-historico">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th title="Usuário com acesso total ao sistema, incluindo configurações e gerenciamento de usuários.">Administrador</th>
                            <th title="Usuário com acesso intermediário, capaz de visualizar relatórios e adicionar novos serviços ao sistema.">Gerente</th>
                            <th title="Usuário com acesso limitado, permitido agendar serviços e consultar o histórico de agendamentos.">Básico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id_funcionario = $array['id_funcionario'];
                        $nome_funcionario = $array['nome_funcionario'];
                        $cargo = $array['nome_cargo'];

                        // Verifica o nível de acesso para o funcionário atual
                        $query_acesso = "SELECT id_acesso FROM controle_acesso WHERE id_funcionario = :id_funcionario";
                        $stmt_acesso = $conexao->prepare($query_acesso);
                        $stmt_acesso->bindParam(':id_funcionario', $id_funcionario);
                        $stmt_acesso->execute();
                        $acessos = $stmt_acesso->fetchAll(PDO::FETCH_COLUMN);
                    
                        // Define o estado dos checkboxes (checked ou não) com base nos acessos recuperados
                        $acessos_map = [
                            1 => in_array(1, $acessos) ? 'checked' : '',
                            2 => in_array(2, $acessos) ? 'checked' : '',
                            3 => in_array(3, $acessos) ? 'checked' : ''
                        ];
                    ?>

                    <tr>
                        <td><?php echo $id_funcionario ?></td>
                        <td><?php echo $nome_funcionario ?></td>
                        <td><?php echo $cargo ?></td>
                        <!-- Níveis de acesso com estados dos checkboxes -->
                        <td><input type="checkbox" class="checkbox" data-funcionario="<?php echo $id_funcionario ?>" data-nivel="1" <?php echo $acessos_map[1] ?>></td>
                        <td><input type="checkbox" class="checkbox" data-funcionario="<?php echo $id_funcionario ?>" data-nivel="2" <?php echo $acessos_map[2] ?>></td>
                        <td><input type="checkbox" class="checkbox" data-funcionario="<?php echo $id_funcionario ?>" data-nivel="3" <?php echo $acessos_map[3] ?>></td>
                    </tr>
                    
                    <?php
                    } 
                    ?>

                </table>
            </div>
        </section>
    </main>

    <?php include_once 'footer.php'; ?>

    <div class="modalAlert">
        <p></p>
    </div>


    <script src="../js/nivelAcesso.js"></script>
</body>

</html>