document.addEventListener('DOMContentLoaded', function () {
    const Perfil = document.getElementById('perfilMeuPerfil');
    const Editar = document.getElementById('editperMeuPerfil');
    const Compras = document.getElementById('comprasMeuPerfil');
    const Atualizar = document.getElementById('att_edit_perfil');


    const ConteudoPerfil = document.getElementById('meuperfilMeuPerfil');
    const ConteudoEditar = document.getElementById('editperfilMeuPerfil');
    const ConteudoCompras = document.getElementById('suascomprasMeuPerfil');


    ConteudoPerfil.style.display = 'block';
    ConteudoEditar.style.display = 'none';
    ConteudoCompras.style.display = 'none';


    Perfil.addEventListener('click', function () {
        ConteudoPerfil.style.display = 'block';
        ConteudoEditar.style.display = 'none';
        ConteudoCompras.style.display = 'none';

    });

    Editar.addEventListener('click', function () {
        ConteudoPerfil.style.display = 'none';
        ConteudoEditar.style.display = 'block';
        ConteudoCompras.style.display = 'none';

    });

    Compras.addEventListener('click', function () {
        ConteudoPerfil.style.display = 'none';
        ConteudoEditar.style.display = 'none';
        ConteudoCompras.style.display = 'block';
    });

    Atualizar.addEventListener('click', function () {
        ConteudoPerfil.style.display = 'none';
        ConteudoEditar.style.display = 'block';
        ConteudoCompras.style.display = 'none';
    });


});