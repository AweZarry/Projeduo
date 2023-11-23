function mostrarCampos(opcao) {
    document.getElementById('opcao').value = opcao;
    document.getElementById("captura").style.display = "none";
    document.getElementById("subcategoria-dicas").style.display = "none";
    document.getElementById("subcategoria-input").style.display = "none";
    document.getElementById("videos").style.display = "none";

    if (opcao === "Capturas de Tela") {
        document.getElementById("captura").style.display = "block";
    } else if (opcao === "Dicas") {
        document.getElementById("subcategoria-dicas").style.display = "block";
        document.getElementById("dicascat").onchange = function () {
            if (this.value !== "") {
                document.getElementById("subcategoria-input").style.display = "block";
            } else {
                document.getElementById("subcategoria-input").style.display = "none";
            }
        };
    } else if (opcao === "Videos") {
        document.getElementById("videos").style.display = "block";
    }
}