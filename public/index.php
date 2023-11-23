<?php
session_start();

require_once('../action/Crud.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$CrudNomes = new CrudNomes($db);
$crudDicas = new CrudDicas($db);
$crudVideo = new CrudVideo($db);
$crudFoto = new CrudFoto($db);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $opcao = $_POST['opcao'];

            if ($opcao == 'Capturas de Tela') {
                $crudFoto->createFoto($_POST);
            } elseif ($opcao == 'Dicas') {
                $crudDicas->createDicas($_POST);
            } elseif ($opcao == 'Videos') {
                $crudVideo->createVideo($_POST);
            }
            break;

        case 'readDicas':
            $dica = $crudDicas->readDicas();
            break;

        case 'readVideo':
            $video = $crudVideo->readVideo();
            break;

        case 'readFoto':
            $foto = $crudFoto->readFoto();
            break;

        default:
            $dica = $crudDicas->readDicas();
            $video = $crudVideo->readVideo();
            $foto = $crudFoto->readFoto();
            break;
    }
} else {
    $dica = $crudDicas->readDicas();
    $video = $crudVideo->readVideo();
    $foto = $crudFoto->readFoto();
}


$jogos = [];
$dicas = [];
$fotos = [];
$videos = [];
$usuarios = [];

$queryu = "SELECT id_usuario, nome_usuario FROM usuario ORDER BY id_usuario DESC LIMIT 8";
$queryd = "SELECT titdicas, id_dicas, hora FROM dicas ORDER BY hora DESC LIMIT 6";
$queryf = "SELECT titcaptura, id_foto, hora FROM fotos ORDER BY hora DESC LIMIT 6";
$queryv = "SELECT titvideo, id_video, hora FROM videos ORDER BY hora DESC LIMIT 6";
$query = "SELECT n1.*, n1.foto_jogo, n1.descricao
          FROM nome n1
          LEFT JOIN nome n2 
          ON n1.nome_jogo = n2.nome_jogo AND n1.id_jogo < n2.id_jogo
          WHERE n2.id_jogo IS NULL
          ORDER BY n1.id_jogo DESC
          LIMIT 6";

$result = $db->query($query);
$resultd = $db->query($queryd);
$resultf = $db->query($queryf);
$resultv = $db->query($queryv);
$resultu = $db->query($queryu);


if ($resultu->rowCount() > 0) {
    while ($row = $resultu->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = $row;
    }
}

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $jogos[] = $row;
    }
}

if ($resultd->rowCount() > 0) {
    while ($row = $resultd->fetch(PDO::FETCH_ASSOC)) {
        $dicas[] = $row;
    }
}

if ($resultf->rowCount() > 0) {
    while ($row = $resultf->fetch(PDO::FETCH_ASSOC)) {
        $fotos[] = $row;
    }
}

if ($resultv->rowCount() > 0) {
    while ($row = $resultv->fetch(PDO::FETCH_ASSOC)) {
        $videos[] = $row;
    }
}

$id_jogo = isset($_GET['id_jogo']) ? $_GET['id_jogo'] : "";

include_once('../view/navbar.php')

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
    <link rel="stylesheet" type="text/css" href="../public/css/index.css">
</head>

<body>
    <div class="container">
        <div class="cima">
            <div class="usuarios">
                <ul class="du_ladin">
                    <li><a href="index.php" id="posts">Novos Usuários</a></li>
                </ul>
                <div class="recentes">
                    <div class="nomeusuario">
                        <li><a href="">Nome do Usuário:</a></li>
                        <div class="azin">
                            <?php foreach ($usuarios as $usuario): ?>
                                <p>
                                    <?php echo $usuario["nome_usuario"]; ?>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="numerousuario">
                        <li><a href="">Chegou em:</a></li>
                        <div class="azin">
                            <?php foreach ($usuarios as $usuario): ?>
                                <p>
                                    <?php echo $usuario["id_usuario"]; ?>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="foto_jogo">
                <h5>MAIS RECENTES</h5>
                <div class="imgz">
                    <div class="slider">
                        <div class="slides">
                            <?php foreach ($jogos as $index => $jogo): ?>
                                <input type="radio" name="radio-btn" id="radio<?php echo $index + 1; ?>"
                                    data-index="<?php echo $index; ?>">
                                <div class="slide">
                                    <div class="slide-content">
                                        <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>"><img src="<?php echo $jogo["foto_jogo"]; ?>"
                                                alt="imagem <?php echo $index + 1; ?>"
                                                data-index="<?php echo $index; ?>" /></a>
                                        <div class="nome-jogo">
                                            <p>
                                                <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>" class="jogo">
                                                    <?php echo $jogo["nome_jogo"]; ?>
                                                </a>
                                            </p>
                                            <p id="dc">
                                                <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>" class="desc">
                                                    <?php echo $jogo["descricao"]; ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="navauto">
                            <?php for ($i = 1; $i <= count($jogos); $i++): ?>
                                <div class="auto-btn<?php echo $i; ?>"></div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="navmanual">
                        <?php for ($i = 1; $i <= count($jogos); $i++): ?>
                            <label for="radio<?php echo $i; ?>" class="manual-btn"></label>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    echo '<script>';
    echo 'const totalJogos = ' . count($jogos) . ';';
    echo '</script>';
    ?>

    <!-- Parte de img rodando e novos usuarios -->
    <div class="comunidade-container">
        <div class="comunidade">
            <div class="topicos">
                <ul class="center-nav">
                    <li class="nav-com"><a href="#" id="posts-link">Novos Posts</a></li>
                    <li class="nav-com"><a href="#" id="topicos-link">Novas Jogos</a></li>
                    <li class="nav-com"><a href="#" id="dicas-link">Novos Dicas</a></li>
                    <?php if (isset($_SESSION['nome'])): ?>
                        <li class="nav-com"><a class="nav-coms" href="#" id="adicionar">+</a></li>
                    <?php else: ?>
                        <li class="nav-com"><a href="../view/entrar.php">Logue Para Postar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div id="conteudo-posts" style="display: block;">
                <?php
                $todosItens = array_merge($fotos, $dicas, $videos);

                usort($todosItens, function ($a, $b) {
                    $dataA = strtotime($a['hora']);
                    $dataB = strtotime($b['hora']);

                    if ($dataA != $dataB) {
                        return $dataB - $dataA;
                    }

                    if (isset($b['id_video']) && isset($a['id_video'])) {
                        return $b['id_video'] - $a['id_video'];
                    } elseif (isset($b['id_foto']) && isset($a['id_foto'])) {
                        return $b['id_foto'] - $a['id_foto'];
                    } elseif (isset($b['id_dicas']) && isset($a['id_dicas'])) {
                        return $b['id_dicas'] - $a['id_dicas'];
                    }

                    return 0;
                });

                $Itens = array_slice($todosItens, 0, 6);

                foreach ($Itens as $item): ?>
                    <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>">
                        <?php
                        if (isset($item["titcaptura"])) {
                            echo $item["titcaptura"];
                        } elseif (isset($item["titdicas"])) {
                            echo $item["titdicas"];
                        } elseif (isset($item["titvideo"])) {
                            echo $item["titvideo"];
                        }

                        ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div id="conteudo-topicos" style="display: none;">
                <?php

                usort($jogos, function ($a, $b) {
                    return $b['id_jogo'] - $a['id_jogo'];
                });

                $Jogos = array_slice($jogos, 0, 6);

                foreach ($Jogos as $jogo): ?>
                    <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>">
                        <?php echo $jogo["nome_jogo"]; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div id="conteudo-dicas" style="display: none;">
                <?php

                usort($dicas, function ($a, $b) {
                    return $b['id_dicas'] - $a['id_dicas'];
                });

                $Dicas = array_slice($dicas, 0, 6);

                foreach ($Dicas as $dica): ?>
                    <a href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>">
                        <?php echo $dica["titdicas"]; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <div id="conteudo-adicionar" style="display: none;">
                <form class="adc_ps" method="POST" action="?action=create" enctype="multipart/form-data">
                    <div class="esquerdaadc">
                        <div class="adc_nome">
                            <label for="nome_jogo">Nome do Jogo</label>
                            <select name="nome_jogo" id="nome_jogo">
                                <option value=""></option>
                                <?php foreach ($jogos as $jogo): ?>
                                    <option value="<?php echo $jogo['id_jogo']; ?>">
                                        <?php echo $jogo['nome_jogo']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="catjg">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" onchange="mostrarCampos(this.value)">
                                <option value=""></option>
                                <option value="Capturas de Tela">Capturas de Tela</option>
                                <option value="Dicas">Dicas</option>
                                <option value="Videos">Vídeos</option>
                            </select>
                        </div>


                        <div class="catsubjg" id="subcategoria-dicas" style="display: none;">
                            <label for="dicascat">Categoria de Dicas</label>
                            <select name="dicascat" id="dicascat">
                                <option value=""></option>
                                <option value="Populares">Populares</option>
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
                    </div>

                    <div class="direitaadc">
                        <div class="capjg" id="captura" style="display: none;">
                            <label for="titcaptura">Titulo</label>
                            <input type="text" name="titcaptura">
                            <label for="captura">Capturas de tela</label>
                            <input type="file" name="captura">
                        </div>

                        <div id="subcategoria-input" style="display: none;">
                            <label for="titdicas ">Titulo da Dica</label>
                            <input type="text" name="titdicas">
                            <label for="dicainput">Dica</label>
                            <textarea class="textadc" name="dicainput" cols="30" rows="10"></textarea>
                        </div>

                        <div class="vidjg" id="videos" style="display: none;">
                            <label for="titvideo">Titulo</label>
                            <input type="text" name="titvideo">
                            <label for="videos">Vídeos</label>
                            <input type="file" name="videos">
                        </div>
                    </div>

                    <input type="hidden" name="opcao" id="opcao" value="">
                    <button type="submit">Cadastrar</button>

                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/telap/imgsjogos.js"></script>
    <script src="../public/js/telap/comuni.js"></script>
    <script src="../public/js/telap/select.js"></script>
</body>

</html>

<?php
include_once('../view/footer.php')
    ?>