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

        $sqlFotos = "SELECT * FROM fotos WHERE id_jogo = :id_jogo";
        $stmtFicas = $db->prepare($sqlFotos);
        $stmtFicas->bindParam(':id_jogo', $id_jogo);
        $stmtFicas->execute();
        $fotosDoJogo = $stmtFicas->fetchAll(PDO::FETCH_ASSOC);

        $sqlVideo = "SELECT * FROM videos WHERE id_jogo = :id_jogo";
        $stmtVideo = $db->prepare($sqlVideo);
        $stmtVideo->bindParam(':id_jogo', $id_jogo);
        $stmtVideo->execute();
        $VideoDoJogo = $stmtVideo->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Jogo não encontrado.";
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_dica'])) {
    if (
        isset($_POST['postador'], $_POST['foto_postador'], $_POST['id_jogo'], $_POST['dicascat'], $_POST['titdicas'], $_POST['dicainput'])
    ) {
        $postador = $_POST['postador'];
        $foto_postador = $_POST['foto_postador'];
        $id_jogo = $_POST['id_jogo'];
        $dicascat = $_POST['dicascat'];
        $titdicas = $_POST['titdicas'];
        $dicainput = $_POST['dicainput'];

        $registroDica = "INSERT INTO dicas (id_jogo, titdicas, dicascat, dicasinput, postador, foto_postador) VALUES (?,?,?,?,?,?)";
        $Dicaenviar = $db->prepare($registroDica);
        $Dicaenviar->bindParam(1, $id_jogo);
        $Dicaenviar->bindParam(2, $titdicas);
        $Dicaenviar->bindParam(3, $dicascat);
        $Dicaenviar->bindParam(4, $dicainput);
        $Dicaenviar->bindParam(5, $postador);
        $Dicaenviar->bindParam(6, $foto_postador);

        if ($Dicaenviar->execute()) {
            print "<script> alert('Dica enviada com sucesso!!! ')</script>";
        } else {
            echo "Erro ao cadastrar a dica: " . $Dicaenviar->errorInfo()[2];
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_captura'])) {
    if (
        isset($_POST['postador'], $_POST['foto_postador'], $_POST['id_jogo'], $_POST['dicascat'], $_POST['titdicas'], $_POST['dicainput'])
    ) {
        $postador = $_POST['postador'];
        $foto_postador = $_POST['foto_postador'];
        $id_jogo = $_POST['id_jogo'];
        $titcaptura = $_POST['titcaptura'];
        $captura = $_POST['captura'];

        $registroFoto = "INSERT INTO fotos (id_jogo, titcaptura, captura, postador, foto_postador) VALUES (?,?,?,?,?)";
        $Fotoenviar = $db->prepare($registroFoto);
        $Fotoenviar->bindParam(1, $id_jogo);
        $Fotoenviar->bindParam(2, $titcaptura);
        $Fotoenviar->bindParam(3, $captura);
        $Fotoenviar->bindParam(4, $postador);
        $Fotoenviar->bindParam(5, $foto_postador);

        if ($Fotoenviar->execute()) {
            print "<script> alert('Foto enviada com sucesso!!! ')</script>";
        } else {
            echo "Erro ao cadastrar a Foto: " . $Fotoenviar->errorInfo()[2];
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_video'])) {
    if (
        isset($_POST['postador'], $_POST['foto_postador'], $_POST['id_jogo'], $_POST['dicascat'], $_POST['titdicas'], $_POST['dicainput'])
    ) {
        $postador = $_POST['postador'];
        $foto_postador = $_POST['foto_postador'];
        $id_jogo = $_POST['id_jogo'];
        $titvideo = $_POST['titvideo'];
        $videos = $_POST['videos'];

        $registroVideo = "INSERT INTO videos (id_jogo, titvideo, videos, postador, foto_postador) VALUES (?,?,?,?,?)";
        $Videoenviar = $db->prepare($registroVideo);
        $Videoenviar->bindParam(1, $id_jogo);
        $Videoenviar->bindParam(2, $titvideo);
        $Videoenviar->bindParam(3, $videos);
        $Videoenviar->bindParam(4, $postador);
        $Videoenviar->bindParam(5, $foto_postador);

        if ($Videoenviar->execute()) {
            print "<script> alert('Video enviado com sucesso!!! ')</script>";
        } else {
            echo "Erro ao cadastrar a dica: " . $Videoenviar->errorInfo()[2];
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
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
    <?php if (isset($_SESSION['nome'])): ?>
        <?php
        $marcos = [];

        $marcola = null;

        $marcola = $_SESSION['id_usuario'];

        $querymarcos = "SELECT * FROM usuario WHERE id_usuario = '$marcola' ";
        $resultm = $db->query($querymarcos);

        if ($resultm->rowCount() > 0) {
            while ($row = $resultm->fetch(PDO::FETCH_ASSOC)) {
                $marcos[] = $row;
            }
        }
        $nome = $marcos[0]['nome_usuario'];
        $foto_usuario = $marcos[0]['foto_usuario'];
        ?>
    <?php endif; ?>

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
                                    <div class="duv">
                                        <p class="">(?)
                                        <div class="tooltip">
                                            <span>O que significa popular?</span>
                                            <span>Significa que o conteúdo que você está vendo recebeu mais avaliações
                                                positivas que negativas no período de tempo escolhido.</span>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="adicional_foto">
                                <?php if (isset($_SESSION['nome'])): ?>
                                    <li class=""><a class="nav-coms" href="#" id="adicionarfoto">Compartilhar uma
                                            Captura</a>
                                    </li>
                                <?php else: ?>
                                    <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div id="captura-add-post">
                        <div class="cap-container">
                            <?php
                            foreach ($fotosDoJogo as $foto): ?>
                                <div class="cappost">
                                    <div class="posts">
                                        <div class="infpostador">
                                            <img src="<?php echo $foto['foto_postador']; ?>" alt="" class="imgpostador">
                                            <p class="postadorname">
                                                <?php echo $foto['postador']; ?>
                                            </p>
                                        </div>
                                        <div class="crudcaptura">
                                            <?php if (isset($_SESSION['nome']) && $_SESSION['nome'] == $foto['postador']): ?>
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
                                    <div class="conteudo-foto">
                                        <div class="nome_captura">
                                            <h3>
                                                <?php echo $foto['titcaptura']; ?>
                                            </h3>
                                        </div>
                                        <div class="assunto-captura">
                                            <img src="<?php echo $foto['captura']; ?>"
                                                alt="<?php echo $foto['captura']; ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="conteudo-dicas" class="cont-dicas" style="display: none;">
                <div class="lados">
                    <div class="contdic">
                        <div class="navsa">
                            <ul class="cima">
                                <li><a href="">Secretos</a></li>
                                <li><a href="">Conquistas</a></li>
                                <li><a href="">Equipamentos</a></li>
                                <li><a href="">Armas</a></li>
                                <li><a href="">Mapas</a></li>
                            </ul>
                            <ul class="baixo">
                                <li><a href="">Dicas Básicas</a></li>
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
                            <li class=""><a class="nav-coms" href="#" id="adicionardica">Compartilhar uma Dica</a></li>
                        <?php else: ?>
                            <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="dicas-cat-post">
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
                            <div class="duv">
                                <p class="">(?)
                                <div class="tooltip">
                                    <span>O que significa popular?</span>
                                    <span>Significa que o conteúdo que você está vendo recebeu mais avaliações
                                        positivas que negativas no período de tempo escolhido.</span>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="adicional_video">
                        <?php if (isset($_SESSION['nome'])): ?>
                            <li class=""><a class="nav-coms" href="#" id="adicionarvideo">Compartilhar um Video</a></li>
                        <?php else: ?>
                            <li class=""><a href="../view/entrar.php">Logue Para Postar</a></li>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="dicas-cat-post">
                    <div class="dicas-container">
                        <?php
                        foreach ($VideoDoJogo as $video): ?>
                            <div class="dicaspost">
                                <div class="posts">
                                    <div class="infpostador">
                                        <img src="<?php echo $video['foto_postador']; ?>" alt="" class="imgpostador">
                                        <p class="postadorname">
                                            <?php echo $video['postador']; ?>
                                        </p>
                                    </div>
                                    <div class="cruddicas">
                                        <?php if (isset($_SESSION['nome']) && $_SESSION['nome'] == $video['postador']): ?>
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
                                <div class="conteudo-video">
                                    <div class="nome_video">
                                        <h3>
                                            <?php echo $video['titvideo']; ?>
                                        </h3>
                                    </div>
                                    <div class="assunto_video">
                                        <h4>
                                            <?php echo $video['videos']; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-dica">
        <span id="fechar-modal-dica">&times;</span>
        <h1>Compartilhar uma Dica</h1>
        <form class="adc_ps" method="POST" action="" id="form-dica">
            <input type="hidden" value="<?php echo $nome ?>" name="postador" id="postador">
            <input type="hidden" value="<?php echo $foto_usuario ?>" name="foto_postador" id="foto_postador">
            <div class="adc_nome">
                <h3>
                    <?php echo $teste['nome_jogo']; ?>
                </h3>
                <input type="hidden" value="<?php echo $teste['id_jogo']; ?>" name="id_jogo" id="id_jogo">
            </div>
            <div class="catsubjg">
                <label for="dicascat">Categoria de Dicas</label>
                <select name="dicascat" id="dicascat">
                    <option value=""></option>
                    <option value="Secretos">Secretos</option>
                    <option value="Conquistas">Conquistas</option>
                    <option value="Equipamento">Equipamentos</option>
                    <option value="Armas">Armas</option>
                    <option value="Dicas Basicas">Dicas Basicas</option>
                    <option value="Mapas">Mapas</option>
                    <option value="Modificações">Modificações</option>
                    <option value="Historia">Hístoria</option>
                    <option value="Criação">Criação</option>
                    <option value="Classes">Classes</option>
                </select>
            </div>
            <div class="titassuntos">
                <label for="titdicas ">Titulo da Dica</label>
                <input type="text" name="titdicas">
                <label for="dicainput">Dica</label>
                <textarea class="textadc" name="dicainput" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" name="cadastrar_dica">Enviar Dica</button>
        </form>
    </div>

    <div id="modal-foto">
        <span id="fechar-modal-foto">&times;</span>
        <h1>Compartilhar uma Captura</h1>
        <form class="adc_ps" method="POST" action="" id="form-foto">
            <input type="hidden" value="<?php echo $nome ?>" name="postador" id="postador">
            <input type="hidden" value="<?php echo $foto_usuario ?>" name="foto_postador" id="foto_postador">
            <div class="adc_nome">
                <h3>
                    <?php echo $teste['nome_jogo']; ?>
                </h3>
                <input type="hidden" value="<?php echo $teste['id_jogo']; ?>" name="id_jogo" id="id_jogo">
            </div>
            <div class="capjg" id="captura">
                <label for="titcaptura">Titulo</label>
                <input type="text" name="titcaptura">
                <label for="captura">Capturas de tela</label>
                <input type="file" name="captura">
            </div>
            <button type="submit" name="cadastrar_foto">Enviar Captura</button>
        </form>
    </div>

    <div id="modal-video">
        <span id="fechar-modal-video">&times;</span>
        <h1>Compartilhar um Video</h1>
        <form class="adc_ps" method="POST" action="" id="form-video">
            <input type="hidden" value="<?php echo $nome ?>" name="postador" id="postador">
            <input type="hidden" value="<?php echo $foto_usuario ?>" name="foto_postador" id="foto_postador">
            <div class="adc_nome">
                <h3>
                    <?php echo $teste['nome_jogo']; ?>
                </h3>
                <input type="hidden" value="<?php echo $teste['id_jogo']; ?>" name="id_jogo" id="id_jogo">
            </div>
            <div class="vidjg" id="videos">
                <label for="titvideo">Titulo</label>
                <input type="text" name="titvideo">
                <label for="videos">Vídeos</label>
                <input type="file" name="videos">
            </div>
            <button type="submit" name="cadastrar_foto">Enviar Video</button>
        </form>
    </div>



    <script src="../public/js/thelost/fable.js"></script>
    <script src="../public/js/thelost/dicasnav.js"></script>
    <script src="../public/js/thelost/teladica.js"></script>
    <script src="../public/js/thelost/telacap.js"></script>
    <script src="../public/js/thelost/telavideo.js"></script>

</body>

</html>

<?php
include_once('../view/footer.php')
    ?>