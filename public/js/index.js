
//Карусель
document.addEventListener("DOMContentLoaded", function () {
    const slideContainer = document.querySelector(".carousel-slide");
    const slides = document.querySelectorAll(".carousel-slide img");
    const dotsContainer = document.querySelector(".carousel-dots");
    const carouselOverlay = document.querySelector(".carousel-overlay");

    let currentIndex = 0;
    let isTransitioning = false; // Флаг для определения, идет ли в данный момент анимация переключения
    let interval = setInterval(autoSlide, 3000); // Инициализация интервала (3 секунды)
    let arrowClicked = false; // Флаг для определения, было ли нажатие на стрелочку

    function updateCarousel() {
        slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Обновление активной точки
        const dots = document.querySelectorAll(".carousel-dot");
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add("active");
            } else {
                dot.classList.remove("active");
            }
        });
    }

    // Создание точек
    slides.forEach(() => {
        const dot = document.createElement("div");
        dot.classList.add("carousel-dot");
        dotsContainer.appendChild(dot);
    });

    // Нажатие на точку для переключения
    const dots = document.querySelectorAll(".carousel-dot");
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            if (!isTransitioning) {
                currentIndex = index;
                updateCarousel();
                clearInterval(interval); // Остановка текущего интервала
                interval = setInterval(autoSlide, 5000); // Запуск нового интервала (5 секунд)
                arrowClicked = false; // Сброс флага нажатия на стрелочку
            }
        });
    });

    // Нажатие на левую стрелочку для переключения влево
    const leftArrow = document.querySelector(".left-arrow");
    leftArrow.addEventListener("click", () => {
        if (!isTransitioning) {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
            clearInterval(interval); // Остановка текущего интервала
            interval = setInterval(autoSlide, 5000); // Запуск нового интервала (5 секунд)
            arrowClicked = true; // Установка флага нажатия на стрелочку
        }
    });

    // Нажатие на правую стрелочку для переключения вправо
    const rightArrow = document.querySelector(".right-arrow");
    rightArrow.addEventListener("click", () => {
        if (!isTransitioning) {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
            clearInterval(interval); // Остановка текущего интервала
            interval = setInterval(autoSlide, 5000); // Запуск нового интервала (5 секунд)
            arrowClicked = true; // Установка флага нажатия на стрелочку
        }
    });

    function autoSlide() {
        if (!isTransitioning) {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
            if (!arrowClicked) {
                clearInterval(interval); // Остановка текущего интервала
                interval = setInterval(autoSlide, 5000); // Запуск нового интервала (5 секунд)
            }
            arrowClicked = false; // Сброс флага нажатия на стрелочку после автопереключения
        }
    }

    // Остановка автоматического переключения при наведении на карусель
    carouselOverlay.addEventListener("mouseenter", () => {
        clearInterval(interval);
    });

    // Возобновление автоматического переключения при уходе курсора с карусели
    carouselOverlay.addEventListener("mouseleave", () => {
        interval = setInterval(autoSlide, 5000); // Запуск нового интервала (5 секунд)
    });

    // Добавление обработчика события завершения анимации переключения
    slideContainer.addEventListener("transitionend", () => {
        isTransitioning = false;
    });

    // Используем флаг, чтобы предотвратить многократные клики
    slideContainer.addEventListener("transitionstart", () => {
        isTransitioning = true;
    });

    updateCarousel();
});


//слайдер для брэндов
const slider = document.querySelector('.brands-slider');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const container = document.querySelector('.brands');
const slideWidth = 242; // Ширина элемента + отступ между элементами

let translateX = 0; // Изначальное значение смещения

function updateButtonsVisibility() {
    if (translateX === 0) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'block';
    }

    const containerWidth = container.offsetWidth;
    const sliderWidth = slider.offsetWidth;

    if (sliderWidth + translateX <= containerWidth) {
        nextBtn.style.display = 'none';
    } else {
        nextBtn.style.display = 'block';
    }
}

updateButtonsVisibility();

prevBtn.addEventListener('click', () => {
    if (translateX < 0) {
        translateX += slideWidth;
        if (translateX > 0) {
            translateX = 0;
        }
        slider.style.transform = `translateX(${translateX}px)`;
        updateButtonsVisibility();
    }
});

nextBtn.addEventListener('click', () => {
    const containerWidth = container.offsetWidth;
    const sliderWidth = slider.offsetWidth;

    if (sliderWidth + translateX > containerWidth) {
        translateX -= slideWidth;
        const minTranslate = -(sliderWidth - containerWidth);
        if (translateX < minTranslate) {
            translateX = minTranslate;
        }
        slider.style.transform = `translateX(${translateX}px)`;
        updateButtonsVisibility();
    }
});




// Слайдер для карточек
const cardsSlider = document.querySelector('.cards-slider');
const prevBtn2 = document.getElementById('prevBtn2');
const nextBtn2 = document.getElementById('nextBtn2');
const cardsContainer = document.querySelector('.cards-hit');
const cardSlideWidth = 238; // Ширина элемента + отступ между элементами

let translateX2 = 0; // Изначальное значение смещения

function updateButtonsVisibility2() {
    if (translateX2 === 0) {
        prevBtn2.style.display = 'none';
    } else {
        prevBtn2.style.display = 'block';
    }

    const cardsContainerWidth = cardsContainer.offsetWidth;
    const cardsSliderWidth = cardsSlider.offsetWidth;

    if (cardsSliderWidth + translateX2 <= cardsContainerWidth) {
        nextBtn2.style.display = 'none';
    } else {
        nextBtn2.style.display = 'block';
    }
}

updateButtonsVisibility2();

prevBtn2.addEventListener('click', () => {
    if (translateX2 < 0) {
        translateX2 += cardSlideWidth;
        if (translateX2 > 0) {
            translateX2 = 0;
        }
        cardsSlider.style.transform = `translateX(${translateX2}px)`;
        updateButtonsVisibility2();
    }
});

nextBtn2.addEventListener('click', () => {
    const cardsContainerWidth = cardsContainer.offsetWidth;
    const cardsSliderWidth = cardsSlider.offsetWidth;

    if (cardsSliderWidth + translateX2 > cardsContainerWidth) {
        translateX2 -= cardSlideWidth;
        const minTranslate2 = -(cardsSliderWidth - cardsContainerWidth);
        if (translateX2 < minTranslate2) {
            translateX2 = minTranslate2;
        }
        cardsSlider.style.transform = `translateX(${translateX2}px)`;
        updateButtonsVisibility2();
    }
});




