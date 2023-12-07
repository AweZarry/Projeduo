<?php
session_start();

require_once('../action/Logcad.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new projeto($db);


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'read':
            $rows = $projeto->read();
            break;
        case 'update':

            if (isset($_POST['id_usuario'])) {
                $projeto->updatePerfil($_POST);
            }

            $rows = $projeto->read();
            break;
        default:
            $rows = $projeto->read();
            break;
    }
} else {
    $rows = $projeto->read();
}

$marcola = $_SESSION['id_usuario'];

$querymarcos = "SELECT * FROM usuario WHERE id_usuario = '$marcola' ";
$resultm = $db->query($querymarcos);

if ($resultm->rowCount() > 0) {
    while ($row = $resultm->fetch(PDO::FETCH_ASSOC)) {
        $marcos[] = $row;
    }
}

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
}


include_once('../view/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" type="text/css" href="../public/css/editperfil.css">
</head>

<body>
    <?php
    $id_usuario = $marcos[0]['id_usuario'];
    $nome = $marcos[0]['nome_usuario'];
    $email_usuario = $marcos[0]['email_usuario'];
    $bio_usuario = $marcos[0]['bio_usuario'];
    $foto_usuario = $marcos[0]['foto_usuario'];
    ?>

    <nav class="navedit">
        <ul class="uledit">
            <li class="liedit"><a href="#" id="perfilMeuPerfil" class="aedit">Meu Perfil</a></li>
            <li class="liedit"><a href="#" id="editperMeuPerfil" class="aedit">Editar Perfil</a></li>
            <li class="liedit"><a href="#" id="comprasMeuPerfil" class="aedit">Compras</a></li>
            <li class="liedit"><a href="../view/logout.php" class="aedit">Sair</a> </li>
        </ul>
    </nav>

    <div id="meuperfilMeuPerfil" style="display: block;">
        <div class="user-panel">
            <div class="user_desc">
                <h1>Descrição</h1>
                <p>
                    Aqui você pode ver as informações sobre seu perfil.
                </p>
                <p>
                    Qualquer dúvida entre em contato conosco:
                </p>
                <p>
                    Via Discord:
                    <a href="https://discord.com/invite/8JSs5KDZDe">
                        Eagle Games
                    </a>
                </p>
                <p>
                    Via Instagram:
                    <a href="https://instagram.com/eaglegames_f?igshid=OGQ5ZDc2ODk2ZA==">
                        @eaglegames_f
                    </a>
                </p>
                <p>
                    Via Twitter:
                    <a href="https://x.com/Awezarry_?t=As4KUObo56s2RZG8k4vKfg&s=08">
                        Criador: Francisco Lara
                    </a>
                </p>
            </div>
            <div class="user-details">
                <h1>Meu perfil</h1>
                <div class="foto">
                    <span>
                        <img src="<?php echo $foto_usuario ?>" alt="" class="imgs_users">
                    </span>
                </div>
                <p> Nome:
                    <?php echo $nome ?>
                </p>
                <p> Email:
                    <span>
                        <?php echo $email_usuario ?>
                    </span>
                </p>
                <p>Biografia:
                    <span>
                        <?php echo $bio_usuario ?>
                    </span>
                </p>

                <button class="att_edit" id="att_edit_perfil">Atualizar</button>
            </div>
        </div>
    </div>
    <div id="editperfilMeuPerfil" style="display: none;">
        <div class="user-panele">
            <div class="user-detailse">
                <h1>Editar Perfil</h1>

                <form action="?action=update" method="POST" enctype="multipart/form-data">
                    <div class="fotoe" id="fotoContainer">
                        <img src="<?php echo $foto_usuario ?>" alt="" class="imgs_user" onclick="selectImage()">
                        <input type="file" name="foto" id="foto" class="imgs_userse" style="display: none"
                            onchange="previewImage()">
                    </div>
                    <p> Nome: </p>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome ?>">

                    <p> Email:</p>
                    <input type="email" name="email" id="email" value="<?php echo $email_usuario ?>">
                    <p>Biografia:</p>
                    <textarea name="biografia" id="biografia" cols="30" rows="10"><?php echo $bio_usuario ?></textarea>

                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">

                    <button type="submit" class="att_edit">Atualizar</button>
                </form>
            </div>
        </div>
    </div>

    <div id="suascomprasMeuPerfil" style="display: none;">
        <div class="">
            <div class="">
                <h1>Suas Compras</h1>
                <p> Nome:
                    <?php echo "$nome" ?>
                </p>
                <p> Email:
                    <?php if (isset($marcos[0]['email_usuario'])): ?>
                        <span>
                            <?php echo $marcos[0]['email_usuario']; ?>
                        </span>
                    <?php endif; ?>
                </p>
                <p>Biografia:
                    <?php if (isset($marcos[0]['bio_usuario'])): ?>
                        <span>
                            <?php echo $marcos[0]['bio_usuario']; ?>
                        </span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>


    <script src="../public/js/editper/navperfil.js"></script>
    <script src="../public/js/editper/imgseli.js"></script>

</body>

</html>