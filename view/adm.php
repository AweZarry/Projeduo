<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../index.php");
    exit();
}

$login = $_SESSION['nome'];


require_once('../action/Crud.php');
require_once('../database/Conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$crudNomes = new CrudNomes($db);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $crudNomes->create($_POST);
            break;
        case 'read':
            $rows = $crudNomes->read();
            break;

        case 'update':
            if (isset($_POST['id_jogo'])) {
                $crudNomes->update($_POST);
            }
            $rows = $crudNomes->read();
            break;
        case 'delete':
            $crudNomes->delete($_GET['id_jogo']);
            $rows = $crudNomes->read();
            break;
        default:
            $rows = $crudNomes->read();
            break;
    }
} else {
    $rows = $crudNomes->read();
}

include_once('../view/navbar.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ADM</title>
    <script src="../public/js/adm/select.js"></script>
    <link rel="stylesheet" type="text/css" href="../public/css/adm.css">
</head>

<body>
    <div class="painel">
        <div class="nav">
            <div class="nav_canto_cima">
                <nav>
                    <h4>Painel de Jogos</h4>
                    <ul class="cimanav">
                        <li><a href="#" id="cadastro-link">Cadastrar Jogo</a></li>
                        <li><a href="#" id="editar-link">Editar Jogo</a></li>
                    </ul>
                </nav>
            </div>
            <img class="imgnav" src="../public/img/login.png" alt="">
            <div class="nav_canto_baixo">
                <nav>
                    <ul class="baixonav">
                        <li>
                            <a href="../public/index.php">
                                Tela Principal
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div id="conteudo-cadastro" style="display: none;">
            <form method="POST" action="?action=create" enctype="multipart/form-data">

                <div class="Jogo">

                    <label for="nome_jogo">Nome do Jogo</label>
                    <input type="text" name="nome_jogo" required>
                    <label for="foto_jogo">Foto do Jogo</label>
                    <input type="file" name="foto_jogo" required>
                    <label for="descricao">Descrição</label>
                    <textarea id="descricaos" name="descricao" required></textarea>

                    <input type="hidden" name="opcao" id="opcao" value="">
                    <button type="submit">Cadastrar</button>

                </div>

            </form>
        </div>
        <div id="conteudo-editar" style="display: block;">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id_jogo'])) {
                $id_jogo = $_GET['id_jogo'];
                $result = $crudNomes->readOne($id_jogo);

                if (!$result) {
                    echo "Registro não encontrado.";
                    exit();
                }
                $caminho_jogo = $result['foto_jogo'];
                $nome_jogo = $result['nome_jogo'];
                $descricao = $result['descricao'];
            ?>
                <div>
                    <form id="formedit" class="fomz" action="?action=update" method="POST" onsubmit="return confirm('Você tem certeza?')">
                        <input type="hidden" name="id_jogo" value="<?php echo $id_jogo ?>">

                        <div>
                            <div>
                                <input type="hidden" name="id_jogo" value="<?php echo $id_jogo ?>">
                                <label for="nome_jogo">Nome do jogo:</label>
                                <input type="text" name="nome_jogo" value="<?php echo $nome_jogo ?>" required>
                                <label for="caminho_jogo">Foto do jogo:</label>
                                <input type="text" name="caminho_jogo" value="<?php echo $caminho_jogo ?>" required>
                                <label for="descricao" class="form-label">Descrição do jogo:</label>
                                <textarea name="descricao" id="descricao" type="text" cols="30" rows="10" required><?php echo $descricao ?></textarea>
                                <button type="submit">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do Jogo</th>
                            <th>Foto do Jogo</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($rows->rowCount() == 0) {
                            echo "<tr>";
                            echo "<td>Nenhum dado encontrado</td>";
                            echo "</tr>";
                        } else {
                            while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['id_jogo'] . "</td>";
                                echo "<td>" . $row['nome_jogo'] . "</td>";
                                echo "<td><img class='imgs' src='" . $row['foto_jogo'] . "' alt=''></td>";
                                echo "<td>" . $row['descricao'] . "</td>";
                                echo "<td>";
                                echo "<a href='?action=update&id_jogo=" . $row['id_jogo'] . "' class='edit' id='entrar'>Editar</a>";
                                echo "<a href='?action=delete&id_jogo=" . $row['id_jogo'] . "' onclick='return confirm(\"Tem certeza que quer apagar esse registro?\")' class='delete' id='entrar'>Excluir</a>";
                                echo "</td>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../public/js/adm/gerenciamento.js"></script>
    <script src="../public/js/adm/ccledt.js"></script>
</body>

</html>