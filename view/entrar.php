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
        $dados = $projeto->ids($login);

        if ($dados) {
            $_SESSION['id_usuario'] = $dados[0]['id_usuario'];
            var_dump($dados);
        }

        if ($projeto->verificarAdm($login)) {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            $_SESSION['adm'] = true;
            header("Location: ../view/adm.php");
            exit();
        } else {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            $_SESSION['adm'] = false;
            header("Location: ../public/index.php");
            exit();
        }
    } else {
        print "<script>alert('Credenciais inválidas')</script>";
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
    <link rel="stylesheet" type="text/css" href="../public/css/logar.css">
</head>

<body>
    <img class="foto" src="../public/img/img2.png" alt="" width="651">


    <form action="" method="POST">
        <div class="logar">

            <img src="../public/img/login.png" alt="" width="202">
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