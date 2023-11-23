<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);

if (isset($_POST['logar'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];



    if ($projeto->logar($login, $senha)) {
        if ($projeto->verificarAdm($login)) {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            $_SESSION['id_usuario'] = $login;
            $_SESSION['adm'] = true;
            header("Location: ../view/adm.php");
            exit();
        } else {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            $_SESSION['id_usuario'] = $login;
            $_SESSION['adm'] = false;
            header("Location: ../public/index.php");
            exit();
        }
    } else {
        print "<script>alert('Credenciais invalidas')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tela de Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/css/logar.css">
</head>

<body>
    <img class="foto" src="../public/img/img2.png" alt="" width="651">


    <form action="" method="POST">
        <div class="logar">

            <img src="../public/img/login.png" alt="" width="202">

            <input type="hidden" value="id_usuario" id="login" name="login">

            <label for="login">Usuário ou E-mail</label>
            <input type="text" name="login" id="login" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <a href="trocarsenha.php" class="senha">Esqueci minha senha</a>

            <input type="submit" value="Logar" name="logar">

            <a href="cadastrar.php" class="cadast">Ainda não tenho conta</a>

        </div>
    </form>


</body>

</html>