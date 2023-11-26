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
    <link rel="stylesheet" type="text/css" href="../public/css/thelost.css">

</head>

<body>
    <div class="grls">
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
                        <div class="esquerdaimg">
                            <img src="<?php echo $teste['foto_jogo']; ?>" alt="<?php echo $teste['nome_jogo']; ?>">
                        </div>
                        <div class="direitatexto">
                            <h2>
                                <?php echo $teste['nome_jogo']; ?>
                            </h2>
                            <h3>
                                <?php echo $teste['datas']; ?>
                            </h3>
                            <p>
                                <?php echo $teste['descricao']; ?>
                            </p>
                        </div>
                    </li>
                </div>

                <div id="conteudo-capturas" style="display: none;">
                    <h4>Capturas de Tela</h4>
                    <div class="ladost">
                        <div class="direselect">
                            <div class="capst">
                                <div class="exibir-container">
                                    <p>EXIBIR</p>
                                    <select name="opções" id="opções" class="opts">
                                        <option value=""></option>
                                        <option value="">Mais Populares (Recentes)</option>
                                        <option value="">Mais Populares (Semana)</option>
                                        <option value="">Mais Antigas</option>
                                    </select>
                                    <p class="duv">(?)</p>
                                </div>
                                <div class="search-container">
                                    <input type="search" class="pesq">
                                    <p class="lpesq">🔎</p>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['nome'])): ?>
                                <li class=""><a class="nav-coms" href="#" id="adicionar">Compartilhar uma Captura</a></li>
                            <?php else: ?>
                                <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="rogs">

                    </div>
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
                            <div class="direselect">
                                <div class="search-container">
                                    <input type="search" class="pesq">
                                    <p class="lpesq">🔎</p>
                                </div>
                            </div>
                            <?php if (isset($_SESSION['nome'])): ?>
                                <li class=""><a class="nav-coms" href="#" id="adicionar">Compartilhar um Video</a></li>
                            <?php else: ?>
                                <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                            <?php endif; ?>
                            <div class="dicas post">
                                <li class="cnt-post"><a href="../view/thelost.php">Fable - The Lost Chapters</a></li>
                                <li class="cnt-post"><a href="../view/ascr.php">Assassin'S Creed Rogue</a></li>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="conteudo-videos" style="display: none;">
                    <h4>Videos</h4>
                    <div class="direselect">
                        <div class="capst">
                            <div class="exibir-container">
                                <p>EXIBIR</p>
                                <select name="opções" id="opções" class="opts">
                                    <option value=""></option>
                                    <option value="">Mais Populares (Recentes)</option>
                                    <option value="">Mais Populares (Semana)</option>
                                    <option value="">Mais Antigas</option>
                                </select>
                                <p class="duv">(?)</p>
                            </div>
                            <div class="search-container">
                                <input type="search" class="pesq">
                                <p class="lpesq">🔎</p>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['nome'])): ?>
                            <li class=""><a class="nav-coms" href="#" id="adicionar">Compartilhar um Video</a></li>
                        <?php else: ?>
                            <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../public/js/thelost/fable.js"></script>

</body>

</html>

<?php
include_once('../view/footer.php')
    ?>