function showContent(contentId) {
    var cadastroContent = document.getElementById('conteudo-cadastro');
    var editarContent = document.getElementById('conteudo-editar');

    cadastroContent.style.display = 'none';
    editarContent.style.display = 'none';

    var selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }
}

document.getElementById('cadastro-link').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-cadastro');
});

document.getElementById('editar-link').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-editar');
});
