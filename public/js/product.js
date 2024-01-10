const productLinks = document.querySelectorAll(".product-link"); // карточка
const substrateCategory2 = document.querySelector(".substrate-category2"); // подложка
const boxForProduct = document.querySelector(".boxForProduct"); // бокс для продукта
const tmplProduct = document.getElementById("tmpl-product").innerHTML;
let iconClose2; // иконка закрытия
let currentURL = window.location.href; // текущий URL

//карусель
let leftArrow; //левую стрелку
let rightArrow; //правая стрелка
let slideContainer; // Контейнер слайдов
let slides; // Слайды
let dotsContainer; // Контейнер для индикаторов точек
let carouselOverlay; // Обертка для слайдера
let currentIndex = 0; // Текущий индекс активного слайда
let isTransitioning = false; // Переменная для отслеживания процесса перехода между слайдами
let arrowClicked = false; // Флаг для определения, был ли выполнен переход между слайдами при клике на стрелки




// базовые настройки для закрытой карточки
function defaultStyleWindow2() {
    boxForProduct.style.display = "none";
    boxForProduct.style.right = "-2000px";
    substrateCategory2.style.display = "none";
    // Вернуться к предыдущему URL
    if (currentURL) {
        history.pushState({}, null, currentURL);
    }
}




// Карусель : Функция для обновления отображения слайдов и индикаторов точек
function updateCarousel() {
    slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

    // Обновление индикаторов точек
    const dots = document.querySelectorAll(".new-carousel-dot");
    dots.forEach((dot, index) => {
        if (index === currentIndex) {
            dot.classList.add("active"); // Пометить активный индикатор точки
        } else {
            dot.classList.remove("active"); // Убрать пометку с неактивных индикаторов точек
        }
    });
}



// событие для подложки 2
substrateCategory2.addEventListener("click", defaultStyleWindow2);




// Загрузка продукта по коду
function loadProductByCode(productCode) {
    fetch(`/productData/${productCode}`)
        .then(response => response.json())
        .then(data => {
            // Очищаем контейнер
            boxForProduct.innerHTML = '';
            // Отобразите данные о товаре в контейнере для товара
            boxForProduct.innerHTML = tmplProduct;

            // Отобразите контейнер
            boxForProduct.style.display = "block";
            substrateCategory2.style.display = "block";
            setTimeout(() => {
                boxForProduct.style.right = "24px";
            }, 100);

            // Получите элемент с id "closeIcon2" из активированного шаблона
            iconClose2 = boxForProduct.querySelector("#closeIcon2"); // Удалите объявление "const"
            // Добавьте событие для иконки закрыть
            iconClose2.addEventListener("click", defaultStyleWindow2);



            // Карусель : Получение ссылок на элементы DOM
            slideContainer = boxForProduct.querySelector(".new-carousel-slide"); // Контейнер слайдов
             slides = boxForProduct.querySelectorAll(".new-carousel-slide img"); // Слайды
             dotsContainer = boxForProduct.querySelector(".new-carousel-dots"); // Контейнер для индикаторов точек
             carouselOverlay = boxForProduct.querySelector(".new-carousel-overlay"); // Обертка для слайдера

            // Создание индикаторов точек для каждого слайда
            slides.forEach(() => {
                const dot = document.createElement("div");
                dot.classList.add("new-carousel-dot");
                dotsContainer.appendChild(dot);
            });

            // Получение всех индикаторов точек и назначение им обработчиков событий
            const dots = document.querySelectorAll(".new-carousel-dot");
            dots.forEach((dot, index) => {
                // Обработчик события клика на индикаторе точки
                dot.addEventListener("click", () => {
                    if (!isTransitioning) {
                        currentIndex = index; // Установить текущий индекс в соответствии с выбранной точкой
                        updateCarousel();
                        arrowClicked = false;
                    }
                });
            });

            // Получение и назначение обработчика события на левую стрелку
            leftArrow = boxForProduct.querySelector(".new-left-arrow");
            // обработчик события на левую стрелку
            leftArrow.addEventListener("click", () => {
                if (!isTransitioning) {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Переход к предыдущему слайду
                    updateCarousel();
                    arrowClicked = true;
                }
            });

            // Получение и назначение обработчика события на правую стрелку
            rightArrow = boxForProduct.querySelector(".new-right-arrow");
            rightArrow.addEventListener("click", () => {
                if (!isTransitioning) {
                    currentIndex = (currentIndex + 1) % slides.length; // Переход к следующему слайду
                    updateCarousel();
                    arrowClicked = true;
                }
            });

            // Обработчик события, который снимает флаг перехода при завершении анимации
            slideContainer.addEventListener("transitionend", () => {
                isTransitioning = false;
            });

            // Обработчик события, который устанавливает флаг перехода при начале анимации
            slideContainer.addEventListener("transitionstart", () => {
                isTransitioning = true;
            });

            // Вызов функции для начального обновления отображения
            updateCarousel();

        })
        .catch(error => console.error(error));
}





// Слушатель на клик на карточку
productLinks.forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();
        const productCode = link.getAttribute("data-product-code");

        // Обновите URL без перезагрузки страницы
        history.pushState({ productCode }, null, `/product/${productCode}`);

        // Загрузите данные о товаре и отобразите их
        loadProductByCode(productCode);
    });
});





document.addEventListener("DOMContentLoaded", function () {
    // Проверьте URL при загрузке страницы
    const currentURLPath = window.location.pathname;
    if (currentURLPath.startsWith('/product/')) {
        const productCode = currentURLPath.split('/').pop();
        loadProductByCode(productCode);
        currentURL = '/'; // Установите начальную страницу по умолчанию
    }
});





