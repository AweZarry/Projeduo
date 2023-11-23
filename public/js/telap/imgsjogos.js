let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const autoIntervalTime = 3000; 
const autoBtns = document.querySelectorAll('.auto-btn1, .auto-btn2, .auto-btn3, .auto-btn4, .auto-btn5, .auto-btn6');
const radioButtons = document.querySelectorAll('input[name="radio-btn"]');
const images = document.querySelectorAll('.slide img');

radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('click', function() {
        const index = this.getAttribute('data-index');
        currentIndex = parseInt(index); 
        showSlide(currentIndex); 
    });
});

function showSlide(index) {
    slides.forEach((slide) => {
        slide.style.display = 'none';
    });

    slides[index].style.display = 'block';
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
    updateAutoBtnBackground();
}

autoBtns.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        currentIndex = index;
        showSlide(currentIndex);
        updateAutoBtnBackground();
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, autoIntervalTime);
    });
});

function updateAutoBtnBackground() {
    autoBtns.forEach((btn, index) => {
        if (index === currentIndex) {
            btn.style.backgroundColor = 'white';
        } else {
            btn.style.backgroundColor = '';
        }
    });
}

let autoSlideInterval = setInterval(nextSlide, autoIntervalTime);

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentIndex);
    updateAutoBtnBackground();
});


