<?php

// Função para retornar uma resposta JSON para o frontend e encerrar o script
function retorna_para_javascript($dados)
{
    header("content-type: Application/json"); // Define o cabeçalho como JSON
    echo json_encode($dados); // Converte o array associativo em JSON e envia como resposta
    exit; // Encerra o script
}

// Recebe os dados enviados pelo formulário via método POST
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome_crianca = $_POST['nome_crianca'];
$nascimento = $_POST['nascimento'];


// Valida se os campos obrigatórios estão preenchidos
if (empty($nome)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda o nome do usuário"
    ]);
}
if (empty($email)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda o email do usuário"
    ]);
}
if (empty($senha)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda a senha do usuário"
    ]);
}
if (empty($nome_crianca)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda o nome da criança"
    ]);
}
if (empty($nascimento)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda a data de nascimento da criança"
    ]);
}

// Conexão com o banco de dados
require_once "../database/conexao_banco.php";


// Verifica se o email já está cadastrado no banco de dados
$query = "SELECT * FROM responsavel WHERE email = '{$email}'";
$ret = $conexao->query($query);
$usuario_com_email_enviado = $ret->fetch(PDO::FETCH_ASSOC);

if (!empty($usuario_com_email_enviado)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Email já cadastrado."
    ]);
}

// Insere os dados do responsável na tabela 'responsavel'
$query = "INSERT INTO responsavel (nome_responsavel, email, senha) VALUES ('{$nome}','{$email}','{$senha}')";
$conexao->exec($query);
$id_inserido = $conexao->lastInsertId(); // Obtém o ID gerado para o novo usuário

// Insere os dados da criança na tabela 'crianca'
$query = "INSERT INTO crianca (nome_crianca, nascimento, id_responsavel) VALUES ('{$nome_crianca}','{$nascimento}','{$id_inserido}')";
$conexao->exec($query);

// Verifica se a inserção do responsável foi bem-sucedida
if (empty($id_inserido)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => 'Não foi possível inserir.'
    ]);
} else {
    //esse trecho capta os dados de id e nome e ja loga apos salvar o formulario startando a session
    session_start();
    $_SESSION['id_responsavel'] = $id_inserido;
    $_SESSION['nome_responsavel'] = $nome;
    // Retorna sucesso com o ID do novo usuário
    $retorno_da_api = [
        'status' => 'sucesso',
        'id_usuario_novo' => $id_inserido
    ];
    retorna_para_javascript($retorno_da_api);
}
