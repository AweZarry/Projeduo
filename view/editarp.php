<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/css/editperfil.css">
</head>

<body>
    <form method="post" action="">
        <div class="cadast">
            <label for="arquivoInput" class="perfilfoto-label">
                <input type="file" id="arquivoInput" class="perfilfoto" accept="image/*">
                <img id="imagemSelecionada" class="preview-img" src="#" alt="Imagem Selecionada">
            </label>
            <div class="cima">
                <label for="nome" class="us">Usuario:</label>
                <label for="email" class="us">Email:</label>
            </div>
            <div class="cima">
                <input type="text" name="nome" placeholder="Nome de usuário:" value="<?php echo $usuarioinf['nome_usuario']; ?>">
                <input type="email" name="email" placeholder="Email:" value="<?php echo $usuarioinf['email_usuario']; ?>">
            </div>
            <input type="submit" value="Cadastrar" name="cadastrar">
    </form>
    <a href="entrar.php"> Já tenho uma conta</a>
    </div>

    <script src="../public/js/editper/imgseli.js"></script>
</body>

</html>