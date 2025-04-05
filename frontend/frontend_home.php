<?php

//verificando 
session_start();

// verificando se tem algum dado na session se não tiver ele manda para a pagina de login
if (empty($_SESSION['id_responsavel'])) {
    header("Location: login.php");
    exit;
}

// se tiver certo ele  exibe o id do usuario 
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>LOGADO</h1> <?= $_SESSION["id_responsavel"] ?>

    <br>
    <!-- redireciona para o php que executa o logout -->
    <a href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">Sair</a>
</body>

</html>