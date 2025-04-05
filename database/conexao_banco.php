<?php
// conexão.php

$dsn = 'mysql:dbname=papinho;host=localhost';
$user = 'root';
$password = '12345678';

try {
    // Tenta estabelecer a conexão
    $conexao = new PDO($dsn, $user, $password);

    // Configura o PDO para lançar exceções em caso de erro
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Trata erros de conexão e exibe a mensagem
    die(json_encode(["status" => "error", "message" => "Erro de conexão: " . $e->getMessage()]));
}
