<?php

include_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_funcionairo = $_POST['id_func'];
    $fotoDoFuncionario = $_FILES['foto_funcionario'];
    $nome_funcionario = $_POST['nome'];
    $contato = $_POST['contato'];
    $situacao = $_POST['situacao'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    /* Explicação da inserção da imagem no banco */
    /* Primeiro crio uma variável que irá recer o conteúdo já formatado da imagem, porém ele está como nulo no momento */
    $conteudo_img = null;

    /* Essa condição verifica se foi adicionado uma imagem ao input file */
    if ($fotoDoFuncionario['error'] == UPLOAD_ERR_OK) { /* Caso tenha imagem ele irá atribuila a variável $conteudo_img */
        $conteudo_img = file_get_contents($fotoDoFuncionario['tmp_name']);
    }

    /* Os parâmetros de dados iniciam sem a informação da imagem, por conta se caso não houver ela poderá fazer update sem haver necessidade dela */
    $novo = [
        'id_func' => $id_funcionairo,
        'nome' => $nome_funcionario,
        'contato' => $contato,
        'situacao' => $situacao,
        'cargo' => $cargo,
        'email' => $email,
        'cep' => $cep,
        'endereco' => $endereco,
        'complemento' => $complemento,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'uf' => $uf,
    ];

    /* Nesta condição há uma verificação se o variável $conteudo_img não está fazia, caso não esteja ele prepara o update e adiciona a img ao array $novo, assim podendo fazer update junto com a imagem */
    if ($conteudo_img !== null) {
        $atualizandoFunc = $conexao->prepare("UPDATE funcionario SET img = :foto, nome_funcionario = :nome, contato = :contato, situacao = :situacao, id_cargo = :cargo, email = :email, cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id_funcionario = :id_func");
        $novo['foto'] = $conteudo_img;
    } else { /* Caso não tenha a imagem na variavel $conteudo_img, o código será preparado sem a necessidade da imagem */
        $atualizandoFunc = $conexao->prepare("UPDATE funcionario SET nome_funcionario = :nome, contato = :contato, situacao = :situacao, id_cargo = :cargo, email = :email, cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id_funcionario = :id_func");
    }

    if ($atualizandoFunc->execute($novo)) {
        header('location: ../views/painelColab.php?msg=Cadastro atualizado');
    } else {
        header('location: ../views/painelColab.php?msg=Erro ao cadastrar funcionário');
    }
}
