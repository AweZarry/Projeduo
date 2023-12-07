<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);

$id_jogo = isset($_GET['id_jogo']) ? $_GET['id_jogo'] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>