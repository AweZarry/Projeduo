function showContent(contentId) {

    document.getElementById('conteudo-posts').style.display = 'none';
    document.getElementById('conteudo-topicos').style.display = 'none';
    document.getElementById('conteudo-dicas').style.display = 'none';
    document.getElementById('conteudo-adicionar').style.display = 'none';

    document.getElementById(contentId).style.display = 'block';
}

document.getElementById('posts-link').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-posts');
});

document.getElementById('topicos-link').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-topicos');
});

document.getElementById('dicas-link').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-dicas');
});

document.getElementById('adicionar').addEventListener('click', function (event) {
    event.preventDefault();
    showContent('conteudo-adicionar');
});