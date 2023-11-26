<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if ($projeto->cadastrar($nome, $email, $senha, $confSenha)) {
        header("Location: ../public/index.php");
    } else {
        echo '<div class="alertss">', "Erro ao cadastrar", '</div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar</title>
    <link rel="stylesheet" type="text/css" href="../public/css/cadastrar.css">
</head>

<body>
    <form method="post" action="">
        <img src="../public/img/img2.png" alt="" class="fotin" width="651">
        <div class="cadast">
            <img src="../public/img/login.png" alt="" width="202">
            <div class="cima">
                <label for="nome" class="us">Usuario:</label>
                <label for="email" class="us">Email:</label>
            </div>
            <div class="cima">
                <input type="text" name="nome" placeholder="Nome de usuário:" required>
                <input type="email" name="email" placeholder="Email:" required>
            </div>
            <div class="baixo">
                <label for="senha">Senha:</label>
                <label for="confSenha">Confirmar Senha:</label>
            </div>
            <div class="baixo">
                <input type="password" name="senha" placeholder="Senha nova:" required maxlength="8">
                <input type="password" name="confSenha" placeholder="Confirme sua senha:" required maxlength="8">
            </div>
            <input type="submit" value="Cadastrar" name="cadastrar">
    </form>
    <a href="entrar.php"> Já tenho uma conta</a>
    <a href="../public/index.php"> Voltar</a>
    </div>
</body>

</html>