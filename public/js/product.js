const productLinks = document.querySelectorAll(".product-link"); // карточка
const substrateCategory2 = document.querySelector(".substrate-category2"); // подложка
const boxForProduct = document.querySelector(".boxForProduct"); // бокс для продукта
const tmplProduct = document.getElementById("tmpl-product").innerHTML;
let iconClose2; // иконка закрытия
let currentURL = window.location.href; // текущий URL


// базовые настройки для закрытой карточки
function defaultStyleWindow2() {
    boxForProduct.style.display = "none";
    substrateCategory2.style.display = "none";
    // Вернуться к предыдущему URL
    if (currentURL) {
        history.pushState({}, null, currentURL);
    }
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

            // Получите элемент с id "closeIcon2" из активированного шаблона
            iconClose2 = boxForProduct.querySelector("#closeIcon2"); // Удалите объявление "const"
            // Добавьте событие для иконки закрыть
            iconClose2.addEventListener("click", defaultStyleWindow2);
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


