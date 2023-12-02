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

        $sqlDicas = "SELECT * FROM dicas WHERE id_jogo = :id_jogo";
        $stmtDicas = $db->prepare($sqlDicas);
        $stmtDicas->bindParam(':id_jogo', $id_jogo);
        $stmtDicas->execute();
        $dicasDoJogo = $stmtDicas->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Jogo não encontrado.";
        exit();
    }
}

include_once('../view/navbar.php');

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
                            <div class="navsa">
                                <ul class="cima">
                                    <li><a href="">Populares</a></li>
                                    <li><a href="">Secretos</a></li>
                                    <li><a href="">Conquistas</a></li>
                                    <li><a href="">Equipamentos</a></li>
                                    <li><a href="">Armas</a></li>
                                </ul>
                                <ul class="baixo">
                                    <li><a href="">Dicas Básicas</a></li>
                                    <li><a href="">Mapas</a></li>
                                    <li><a href="">Modificações</a></li>
                                    <li><a href="">História</a></li>
                                    <li><a href="">Criação</a></li>
                                    <li><a href="">Classes</a></li>
                                </ul>
                            </div>
                            <div id="mostrar-mais">Mais</div>
                            <div id="ocultar-mais" style="display: none;">Ocultar</div>
                        </div>
                        <div id="adicional_dicas">
                            <?php if (isset($_SESSION['nome'])): ?>
                                <li class=""><a class="nav-coms" href="#" id="adicionar">Compartilhar um Dica</a></li>
                            <?php else: ?>
                                <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="categorias-dinamicas">
                        <div class="dicas-container">
                            <?php
                            foreach ($dicasDoJogo as $dica): ?>
                                <div class="dicaspost">
                                    <div class="posts">
                                        <div class="infpostador">
                                            <img src="<?php echo $dica['foto_postador']; ?>" alt="" class="imgpostador">
                                            <p class="postadorname">
                                                <?php echo $dica['postador']; ?>
                                            </p>
                                        </div>
                                        <div class="cruddicas">
                                            <?php if (isset($_SESSION['nome']) && $_SESSION['nome'] == $dica['postador']): ?>
                                                <a href=""><img src="../public/img/delete.png" alt=""></a>
                                                <a href=""><img src="../public/img/engrenagem.png" alt=""></a>
                                            <?php else: ?>
                                                <a href=""><img src="../public/img/semcurtir.png" alt=""></a>
                                                <?php if (isset($_SESSION['nome']) && isset($_SESSION['adm']) && $_SESSION['adm']): ?>
                                                    <a href=""> <img src="../public/img/delete.png" alt=""></a>
                                                <?php else: ?>
                                                    <a href=""> <img src="../public/img/comentar.png" alt=""></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="conteudo">
                                        <div class="nome_dica">
                                            <h3>
                                                <?php echo $dica['titdicas']; ?>
                                            </h3>
                                            <h4>
                                                <?php echo $dica['dicascat'] ?>
                                            </h4>
                                        </div>
                                        <div class="assunto-dica">
                                            <h4>
                                                <?php echo $dica['titdicas']; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
    <script src="../public/js/thelost/dicasnav.js"></script>



</body>

</html>

<?php
include_once('../view/footer.php')
    ?>