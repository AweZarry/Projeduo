function atualizarRoda() {
    const textarea = document.getElementById('entrada');
    const rodagradi = document.getElementById('rodagradi');
    const roda = document.getElementById('roda');

    let nivel = textarea.value.length;
    nivel = Math.min(255, nivel);
    

    if (nivel >= 255) {
        textarea.maxLength = textarea.value.length;
    } else {
        textarea.maxLength = 255;
    }

    roda.textContent = `${nivel}`;

    const gradiente = `linear-gradient(to bottom, white ${100 - (nivel / 255) * 100}%, #ec5353  0%, #ff0000 0%)`;
    rodagradi.style.background = gradiente;
}
