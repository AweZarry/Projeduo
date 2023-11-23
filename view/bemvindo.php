<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location cadastrar.php");
    exit();
}

$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/css/telap.css">
</head>

<body>
    <h1>Eagle Games</h1>
    <h2>Seja bem vindo <?php echo $nome; ?> </h2>
    <img class="seta" src="../public/img/seta.png" alt="">
    <a href="telap.php">PROSSEGUIR</a>
    <img class="logo" src="../public/img/login.png" alt="">

    <h3>Bem-vindo ao nosso universo de RPG!
        Aqui, você encontrará <br> as melhores dicas
        e truques para acelerar sua jornada.</h3>

    <h4>Nossa comunidade está pronta para compartilhar seus segredo
        e experiências garantindo que <br> sua aventura seja repleta
        de sucesso e diversão.<br> Prepare-se para mergulhar em um mundo de
        possibilidades e conquistas!</h4>

    <h5>Descubra estratégias para ganhar XP de forma eficiente,
        complete missões emocionantes <br> sem complicações
        e desbloqueie skins incríveis para personalizar seu personagem</h5>

    <a href="index.php">Sair</a>

</body>

</html>