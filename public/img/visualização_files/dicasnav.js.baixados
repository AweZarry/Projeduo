document.addEventListener('DOMContentLoaded', function() {
    var mostrarMaisBtn = document.getElementById('mostrar-mais');
    var ocultarMaisBtn = document.getElementById('ocultar-mais');
    var listaItens = document.querySelectorAll('.baixo li');

    mostrarMaisBtn.addEventListener('click', function() {
        listaItens.forEach(function(item) {
            item.style.display = 'block';
        });

        mostrarMaisBtn.style.display = 'none';
        ocultarMaisBtn.style.display = 'block';
    });

    ocultarMaisBtn.addEventListener('click', function(){
        listaItens.forEach(function(item, index){
            if (index < 0) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        mostrarMaisBtn.style.display = 'block';
        ocultarMaisBtn.style.display = 'none';
    });


});