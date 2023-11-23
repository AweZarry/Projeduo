<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="?action=create">
        <div>
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" onchange="mostrarCampos(this.value)">
                <option value="Capturas de Tela">Capturas de Tela</option>
                <option value="Dicas">Dicas</option>
                <option value="Videos">Vídeos</option>
            </select>
        </div>
        <div id="captura" style="display: none;">
            <label for="titcaptura">Titulo</label>
            <input type="text" name="titcaptura">
            <label for="captura">Capturas de tela</label>
            <input type="file" name="captura">
        </div>

        <div id="subcategoria-dicas" style="display: none;">
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

        <div id="subcategoria-input" style="display: none;">
            <label for="titdicas">Titulo da Dica</label>
            <input type="text" name="titdicas">
            <label for="dicainput">Dicas</label>
            <input type="text" name="dicainput" id="subcategoria-input">
        </div>

        <div id="videos" style="display: none;">
            <label for="titvideo">Titulo</label>
            <input type="text" name="titvideo">
            <label for="videos">Vídeos</label>
            <input type="file" name="videos">
        </div>
        <input type="hidden" name="opcao" id="opcao" value="">
        <button type="submit">Cadastrar</button>
    </form>
    <footer class="footer">
        <?php include_once('../view/footer.php'); ?>
    </footer>
</body>

</html>