document.addEventListener('DOMContentLoaded', function() {
    const arquivoInput = document.getElementById('arquivoInput');
    const imagemSelecionada = document.getElementById('imagemSelecionada');

    arquivoInput.addEventListener('change', function () {
        const arquivo = arquivoInput.files[0];
        const leitor = new FileReader();

        leitor.onload = function (e) {
            imagemSelecionada.src = e.target.result;
        };

        if (arquivo) {
            leitor.readAsDataURL(arquivo);
        }
    });
});





