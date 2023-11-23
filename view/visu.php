<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);

$teste = null;

if (isset($_GET['id_jogo'])) {
    $id_jogo = $_GET['id_jogo'];

    $sql = "SELECT * FROM nome WHERE id_jogo = :id_jogo";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_jogo', $id_jogo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $teste = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Jogo não encontrado.";
        exit();
    }
}

include_once('../view/navbar.php')

    ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visualização</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/css/thelost.css">

</head>

<body>
    <h1 class="nms">
        <?php echo $teste['nome_jogo']; ?>
    </h1>
    <div class="imgfundo">
        <div class="comeco">
            <div class="row">
                <div class="col">
                    <li class="nav-com"><a href="#" id="tudo">Tudo</a></li>
                </div>
                <div class="col">
                    <li class="nav-com"><a href="#" id="capturas">Capturas de telas</a></li>
                </div>
                <div class="col">
                    <li class="nav-com"><a href="#" id="dicas">Dicas</a></li>
                </div>
                <div class="col">
                    <li class="nav-com"><a href="#" id="video">Videos</a></li>
                </div>
            </div>
            <div id="conteudo-tudo" style="display: none;">
                <li class="cnt-post">
                    <img src="<?php echo $teste['foto_jogo']; ?>" alt="<?php echo $teste['nome_jogo']; ?>">
                    <p>Cada pessoa que você ajuda, cada flor que você esmaga e cada criatura que você mata <br>
                        mudarão este mundo para sempre. Fable: Quem você será?
                    </p>
                </li>
            </div>

            <div id="conteudo-capturas" style="display: none;">
                <h4>Capturas de Tela</h4>
                <ul>
                    <li>
                        <p>EXIBIR</p>
                    </li>
                    <li><select name="" id="">
                            <option value="">lalala</option>
                        </select></li>
                    <li><input type="search"></li>
                    <li><a href="">Compartilhar uma Captura de Tela</a></li>
                </ul>
                <li class="cnt-tudo"><a href="../view/thelost.php">Fable - The Lost Chapters</a></li>
                <li class="cnt-tudo"><a href="../view/ascr.php">Assassin'S Creed Rogue</a></li>
            </div>

            <div id="conteudo-dicas" class="cont-dicas" style="display: none;">
                <div class="lados">
                    <div class="contdic">
                        <h4>Dicas</h4>
                        <ul>
                            <li><a href="">Pupolares</a></li>
                            <li><a href="">Secretos</a></li>
                            <li><a href="">Conquistas</a></li>
                            <li><a href="">Equipamentos</a></li>
                            <li><a href="">Armas</a></li>
                            <li><a href="">Dicas Basicas</a></li>
                            <li><a href="">Mapas</a></li>
                            <li><a href="">Modificações</a></li>
                            <li><a href="">Historia</a></li>
                            <li><a href="">Criação</a></li>
                            <li><a href="">Classes</a></li>
                        </ul>
                        <li class="cnt-post"><a href="../view/thelost.php">Fable - The Lost Chapters</a></li>
                        <li class="cnt-post"><a href="../view/ascr.php">Assassin'S Creed Rogue</a></li>
                    </div>
                    <div id="adicional_dicas">
                        <h4>Dicas</h4>
                        <ul>
                            <li><a href="">Pupolares</a></li>
                            <li><a href="">Secretos</a></li>
                            <li><a href="">Conquistas</a></li>
                            <li><a href="">Equipamentos</a></li>
                            <li><a href="">Armas</a></li>
                            <li><a href="">Dicas Basicas</a></li>
                            <li><a href="">Mapas</a></li>
                            <li><a href="">Modificações</a></li>
                            <li><a href="">Historia</a></li>
                            <li><a href="">Criação</a></li>
                            <li><a href="">Classes</a></li>
                        </ul>
                        <li class="cnt-post"><a href="../view/thelost.php">Fable - The Lost Chapters</a></li>
                        <li class="cnt-post"><a href="../view/ascr.php">Assassin'S Creed Rogue</a></li>
                    </div>
                </div>
            </div>


            <div id="conteudo-videos" style="display: none;">
                <h4>Videos</h4>
                <li class="cnt-post"><a href="../view/thelost.php">Fable - The Lost Chapters</a></li>
                <li class="cnt-post"><a href="../view/ascr.php">Assassin'S Creed Rogue</a></li>
            </div>
        </div>
    </div>

    <script src="../public/js/thelost/fable.js"></script>

</body>

</html>

<?php
include_once('../view/footer.php')
    ?>