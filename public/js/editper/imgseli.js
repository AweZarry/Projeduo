function previewImage() {
    var input = document.getElementById('foto');
    var imgContainer = document.getElementById('fotoContainer');
    var currentImage = imgContainer.querySelector('img');

    if (currentImage) {
        imgContainer.removeChild(currentImage);
    }

    var newImage = document.createElement('img');
    newImage.src = URL.createObjectURL(input.files[0]);

    input.style.display = 'none';

    imgContainer.appendChild(newImage);
}

function selectImage() {
    var input = document.getElementById('foto');
    var imgContainer = document.getElementById('fotoContainer');

    input.style.display = 'block';

    var currentImage = imgContainer.querySelector('img');
    if (currentImage) {
        imgContainer.removeChild(currentImage);
    }
}