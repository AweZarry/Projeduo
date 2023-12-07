<?php
$jogos = [];
$usuarios = [];



$queryu = "SELECT id_usuario, nome_usuario FROM usuario ORDER BY id_usuario DESC LIMIT 8";
$query = "SELECT n1.*, n1.foto_jogo
          FROM nome n1
          LEFT JOIN nome n2 
          ON n1.nome_jogo = n2.nome_jogo AND n1.id_jogo < n2.id_jogo
          WHERE n2.id_jogo IS NULL
          ORDER BY n1.id_jogo DESC
          LIMIT 8";

$result = $db->query($query);
$resultu = $db->query($queryu);


if($resultu->rowCount() > 0) {
    while($row = $resultu->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = $row;
    }
}

if($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $jogos[] = $row;
    }
}


$id_jogo = isset($_GET['id_jogo']) ? $_GET['id_jogo'] : "";

?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .navbar {
            background-color: #333;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            height: 60px;
            max-height: 70px;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 2px 10px #FFF;
        }

        .navbar-brand {
            display: inline-block;
            color: aliceblue;
            text-decoration: none;
        }

        .navbar-brand img {
            float: left;
            width: 80px;
            height: auto;
            position: relative;
            bottom: 5px;
        }

        .navbar-nav {
            display: inline-block;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            display: inline-block;
            margin-right: 20px;
        }

        .nav-link {
            color: aliceblue;
            text-decoration: none;
            transition: 0.3s;
        }

        .esquerda .nav-link {
            position: relative;
            bottom: 30px;
        }

        .nav-link:hover {
            color: aliceblue;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            background-color: #333;
            min-width: 100px;
            border: 1px solid #FFF;
            z-index: 1;
        }

        #drop {
            position: absolute;
            top: -8px;
            width: 220px;
        }

        span.nav-link.dropdown-toggle {
            margin-right: 30px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            color: aliceblue;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: 0.3s;
        }

        .dropdown-item:hover {
            color: aliceblue;
            background-color: #fff;
        }

        .esquerda {
            float: left;
            max-height: 66.56px;
        }

        .direita {
            float: right;
            max-height: 66.56px;
            display: flex;
            align-items: center;
        }

        .imgs_user {
            float: left;
            width: 60px;
            height: 60px;
            border-radius: 90px;
        }

        .user_lad {
            display: flex;
            align-items: center;
        }

        #lado_dir {
            width: 160px;
            position: absolute;
        }

        .foto_user img{
            width: 50px;
            height: 50px;
            border-radius: 100px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="esquerda">
            <a class="navbar-brand" href="../public/index.php">
                <img src="../public/img/login.png" alt="logo">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../public/index.php">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <span class="nav-link">Tópicos de Jogos</span>
                    <div class="dropdown-content" id="drop">
                        <?php foreach($jogos as $jogo): ?>
                            <a class="dropdown-item" href="../view/visu.php?id_jogo=<?= $jogo["id_jogo"] ?>">
                                <?php echo $jogo["nome_jogo"]; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sobre">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/rank.php">Ranks</a>
                </li>
            </ul>
        </div>
        <div class="direita">
            <ul>
                <?php if(isset($_SESSION['nome'])): ?>
                    <?php
                    $marcos = [];

                    $marcola = null;

                    $marcola = $_SESSION['id_usuario'];

                    $querymarcos = "SELECT * FROM usuario WHERE id_usuario = '$marcola' ";
                    $resultm = $db->query($querymarcos);

                    if($resultm->rowCount() > 0) {
                        while($row = $resultm->fetch(PDO::FETCH_ASSOC)) {
                            $marcos[] = $row;
                        }
                    }
                    ?>
                    <div class="dropdown">
                        <div class="user_lad">
                            <span class="nav-link dropdown-toggle">Bem-vindo,
                                <?php echo $marcos[0]['nome_usuario']; ?> !
                            </span>
                            <span class="foto_user"><img src="<?php echo $marcos[0]['foto_usuario']; ?>" alt=""></span>
                        </div>
                        <div class="dropdown-content" id="lado_dir">
                            <?php if($_SESSION['adm']): ?>
                                <a class="dropdown-item" href="../view/adm.php">Painel ADM</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="../view/editarp.php">Meu Perfil</a>
                            <a class="dropdown-item" href="../view/logout.php">Sair</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="nav-item">
                        <a class="nav-link" href="../view/entrar.php">Logar</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="../view/cadastrar.php">Cadastrar</a>
                    </div>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</body>