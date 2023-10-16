const categoryBoxBrands2 = document.querySelector(".category-boxBrands2");
const categoryBoxBrands = document.querySelector(".category-boxBrands");
const maxWindowButton = document.getElementById("maxWindow");
const imgLogo1 = document.getElementById("left-box-1-img");
const textBars = document.querySelectorAll(".textCategoryBar");
const leftBox = document.querySelector(".left-box-1");
const leftBox2 = document.querySelector(".left-box-2");
const leftBox3 = document.querySelector(".left-box");
const leftBoxContainer = document.querySelector(".left-box-container");
const containerContent = document.querySelector(".container");
const containerCenterTop = document.querySelector(".center-top");
const noIsOpenIcon = document.getElementById("noIsOpenIcon");
const isOpenIcon = document.getElementById("isOpenIcon");
const footer = document.querySelector(".footer");
const logoMin = document.querySelector(".logomin");
const logoMin2 = document.querySelector(".logomin2");
const logoMin3 = document.querySelector(".logomin3");
const phoneChatBox = document.querySelector(".phoneChatBox");
const phoneChatBox2 = document.querySelector(".phoneChatBox2");
const phoneBox = document.querySelector(".phoneBox");
const imgPhoneBox = document.getElementById("imgPhoneBox");
const textPhoneBox = document.getElementById("textPhoneBox");
const chatBox = document.querySelector(".chatBox");
const phoneChatLine = document.querySelector(".phoneChatLine");
const preloader = document.querySelector(".preloader");
const boxCategories = document.querySelectorAll(".box-category");
const substrateCategory = document.querySelector(".substrate-category");





//Карточка с товаром если 2 изображения смена изображения если 1 то остаемся на месте
const cardTopContainers = document.querySelectorAll(".card-top-container");


cardTopContainers.forEach((cardTopContainer) => {
    const cardHidenImg = cardTopContainer.querySelector(".card-hiden-img");
    let hasMultipleImages = cardHidenImg.children.length > 1;

    cardTopContainer.addEventListener("mouseenter", function () {
        if (hasMultipleImages) {
            cardHidenImg.style.transform = "translateX(-150px)";
        }
    });

    cardTopContainer.addEventListener("mouseleave", function () {
        if (hasMultipleImages) {
            cardHidenImg.style.transform = "translateX(0)";
        }
    });
});






// Сначала устанавливаем кнопку "Криптовалюты" активной и отображаем соответствующий контент.
showCryptoContent();

function showCryptoContent() {
    document.getElementById('crypto-content').style.display = 'block';
    document.getElementById('wallet-content').style.display = 'none';

    // Добавляем классы для активной кнопки "Криптовалюты"
    document.getElementById('btn-menu-1').classList.add('active-menu');
    document.getElementById('btn-menu-2').classList.remove('active-menu');

    // Добавляем классы для неактивной кнопки "Кошелек"
    document.getElementById('btn-menu-1').classList.remove('inactive-menu');
    document.getElementById('btn-menu-2').classList.add('inactive-menu');


}

function showWalletContent() {
    document.getElementById('crypto-content').style.display = 'none';
    document.getElementById('wallet-content').style.display = 'block';

    // Добавляем классы для активной кнопки "Кошелек"
    document.getElementById('btn-menu-1').classList.remove('active-menu');
    document.getElementById('btn-menu-2').classList.add('active-menu');

    // Добавляем классы для неактивной кнопки "Криптовалюты"
    document.getElementById('btn-menu-1').classList.add('inactive-menu');
    document.getElementById('btn-menu-2').classList.remove('inactive-menu');


}

// Установить значение по умолчанию на "USDT"
document.getElementById("currency").value = "USDT";






// Увеличение или уменьшение рабочей области

let isOpen = true;

// Функция для временного отключения анимации
function disableTransition() {
    // Добавляем класс no-transition к элементам, которые не должны анимироваться
    leftBox.style.transition = "none";
    logoMin2.style.transition = "none";
    leftBox3.style.transition = "none";
    imgLogo1.style.transition = "none";
    containerCenterTop.style.transition = "none";
    footer.style.transition = "none";
    phoneChatBox.style.transition = "none";
    phoneChatBox2.style.transition = "none";
    phoneBox.style.transition = "none";
    textPhoneBox.style.transition = "none";
    chatBox.style.transition = "none";
    imgPhoneBox.style.transition = "none";
    containerContent.style.transition = "none";
    logoMin.style.transition = "none";
}


// Функция для включения анимации после изменения значения isOpen
function enableTransition() {
    // Убираем класс no-transition, чтобы включить анимацию
    leftBox.style.transition = "";
    logoMin2.style.transition = "";
    leftBox3.style.transition = "";
    imgLogo1.style.transition = "";
    containerCenterTop.style.transition = "";
    footer.style.transition = "";
    phoneChatBox.style.transition = "";
    phoneChatBox2.style.transition = "";
    phoneBox.style.transition = "";
    textPhoneBox.style.transition = "";
    chatBox.style.transition = "";
    imgPhoneBox.style.transition = "";
    containerContent.style.transition = "";
    logoMin.style.transition = "";

}


// Функция для применения стилей в зависимости от значения isOpen

function applyStyles() {
    if (isOpen) {
        // Ваши стили для открытой рабочей области
        logoMin.style.display = "none";
        logoMin2.style.opacity = 0;
        leftBox3.style.width = "236px";
        leftBoxContainer.style.padding = "24px 24px 68px 24px";
        imgLogo1.style.margin = "38px 0px 0px 30px";
        textBars.forEach(element => element.style.opacity = 1);
        containerContent.style.margin = "0px 384px 0px 284px";
        containerCenterTop.style.left = "284px";
        isOpenIcon.style.display = "block";
        noIsOpenIcon.style.display = "none";
        footer.style.left = "284px";
        phoneChatBox.style.width = "236px";
        phoneChatBox.style.marginBottom = "0px";
        phoneChatBox2.style.width = "188px";
        phoneChatBox2.style.height = "40px";
        phoneChatBox2.style.margin = "24px 0 0 24px";
        phoneChatBox2.style.flexDirection = "";
        phoneBox.style.marginLeft = "22px";
        textPhoneBox.style.display = "block";
        chatBox.style.margin = "0px 22px 0px 0px";
        imgPhoneBox.style.margin = "0px 10px 0px 0px";
        phoneChatLine.style.height = "24px";
        phoneChatLine.style.width = "1px";

        // Поставим команду с задержкой, чтобы она выполнилась после остальных
        setTimeout(() => {
            leftBox2.classList.remove("hidden2");
            leftBox.style.height = '82px';
            imgLogo1.style.opacity = 1;
        }, 500);
    } else {
        // Ваши стили для закрытой рабочей области
        containerContent.style.margin = "0px 384px 0px 112px";
        leftBox.style.height = '0px';
        leftBox2.classList.add("hidden2");
        leftBox3.style.width = "64px";
        leftBoxContainer.style.padding = "74px 12px 78px";
        imgLogo1.style.opacity = 0;
        imgLogo1.style.margin = "0px";
        textBars.forEach(element => element.style.opacity = 0);
        containerCenterTop.style.left = "112px";
        isOpenIcon.style.display = "none";
        noIsOpenIcon.style.display = "block";
        footer.style.left = "112px";
        phoneChatBox.style.width = "64px";
        phoneChatBox.style.marginBottom = "16px";
        phoneChatBox2.style.width = "40px";
        phoneChatBox2.style.height = "auto";
        phoneChatBox2.style.margin = "12px";
        phoneChatBox2.style.flexDirection = "column";
        phoneBox.style.marginLeft = "0px";
        textPhoneBox.style.display = "none";
        chatBox.style.margin = "12px 0px";
        imgPhoneBox.style.margin = "12px 0px";
        phoneChatLine.style.height = "1px";
        phoneChatLine.style.width = "24px";
        setTimeout(() => {
            logoMin.style.display = "flex";
        }, 400);
        setTimeout(() => {
            logoMin2.style.opacity = 1;
        }, 500);
    }
}

// Проверка и запись значения isOpen в localStorage, если оно равно null
if (localStorage.getItem('isOpen') === null) {
    localStorage.setItem('isOpen', JSON.stringify(isOpen));
}



// Загрузка значения isOpen из localStorage при загрузке страницы
window.addEventListener('load', () => {
    const storedIsOpen = localStorage.getItem('isOpen');
    isOpen = JSON.parse(storedIsOpen);

    // Примените стили при загрузке страницы
    disableTransition(); // Отключаем анимацию при загрузке
    applyStyles();
    helperBigWindow();
    setTimeout(() => {
        enableTransition(); // Включаем анимацию после применения стилей
        preloader.classList.add('preloader_hidden') // Включаем прилодер
    }, 700);
});

// Обработчик события для кнопки "Увеличение/уменьшение рабочей области"
maxWindowButton.addEventListener("click", () => {
    isOpen = !isOpen;

    // Сохранение значения isOpen в localStorage
    localStorage.setItem('isOpen', JSON.stringify(isOpen));

    // Примените стили после изменения значения isOpen
    applyStyles();
    helperBigWindow();

});





//подложка под категории и меню
document.addEventListener("DOMContentLoaded", function() {

    const closeIcon = document.querySelector(".substrate-category-closeIcon");
    const leftBox = document.querySelector(".left-box");
    const categoryNameElement = document.getElementById("category-name");
    const boxSubcategoryBrands = document.getElementById("box-subcategory-brands");
    const tmplBrandsSubcategory = document.getElementById("tmpl-brand-subcategory").innerHTML;


    // Обработчик клика для каждого элемента .box-category
    boxCategories.forEach(function(boxCategory) {
        boxCategory.addEventListener("click", function() {
            // Сначала возвращаем стили всех .box-category к исходным значениям
            boxCategories.forEach(function(category) {
                category.querySelector(".textCategoryBar").style.color = "";
                category.querySelector(".box-category-img-hover").style.opacity = "";
                category.querySelector(".textCategoryBar2").style.display = "none";
            });

            if (getIsOpen() === false) {
                styleBigWindowCatalogActive()
            }

            // Скрываем .category-boxBrands

            if (categoryBoxBrands2.style.display === "block") {
                    categoryBoxBrands2.style.left = "284px";
                    setTimeout(() => {
                        categoryBoxBrands2.style.display = "none";
                    }, 400);
                    setTimeout(() => {
                        categoryBoxBrands.style.left = "24px";
                    }, 400);
                    setTimeout(() => {
                    categoryBoxBrands.style.display = "none";
                    }, 800);
            }else {
                categoryBoxBrands.style.left = "24px";
                setTimeout(() => {
                    categoryBoxBrands.style.display = "none";
                }, 400);
            }


            // Применяем стили к текущему .box-category
            const textCategoryBar = boxCategory.querySelector(".textCategoryBar");
            const boxCategoryImgHover = boxCategory.querySelector(".box-category-img-hover");
            const textCategoryBar2 = boxCategory.querySelector(".textCategoryBar2");

            textCategoryBar.style.color = "rgb(64, 64, 64)";
            boxCategoryImgHover.style.opacity = "1";
            textCategoryBar2.style.display = "block";

            // Показываем .substrate-category
            substrateCategory.style.display = "block";
            // Устанавливаем z-index для .left-box-1 и .left-box-2
            leftBox.style.zIndex = "5";

            // Показываем .category-boxBrands и устанавливаем стили
            if (categoryBoxBrands2.style.display === "block") {
                setTimeout(() => {
                    categoryBoxBrands.style.display = "block";
                    setTimeout(() => {
                        categoryBoxBrands.style.left = "284px";
                    }, 100);
                }, 800);
            }else {
                setTimeout(() => {
                    categoryBoxBrands.style.display = "block";
                    setTimeout(() => {
                        categoryBoxBrands.style.left = "284px";
                    },10);
                }, 400);
            }


            // Получите ID выбранной категории из атрибута data-category-id
                const categoryId = boxCategory.getAttribute("data-category-id");
            // Обновляем название категории
            setTimeout(function() {
            categoryNameElement.textContent = textCategoryBar.textContent;

                axios.get(`/get-subcategories-and-brands/${categoryId}`)
                .then(function (response) {
                    const data = response.data;
                    // очищаем контейнер
                    boxSubcategoryBrands.innerHTML = '';
                    if (data["subcategories"].length > 0) {
                        data["subcategories"].sort((a, b) => {
                            return a['id'] - b['id'];
                        });
                        for (let i = 0; i < data["subcategories"].length; i++) {
                            boxSubcategoryBrands.innerHTML += tmplBrandsSubcategory.replace("${img_brand_subcategory}",data["subcategories"][i]['image'])
                                .replace("${name_brand_subcategory}",data["subcategories"][i]['name'])
                                .replace("${data-brand-or-subcategory}","subcategories")
                                .replace("${data-category-id2}",`${categoryId}`)
                                .replace("${id-brand-or-subcategory}",data["subcategories"][i]['id'])

                        }
                    }else {
                        data["brands"].sort((a, b) => {
                            return a['id'] - b['id'];
                        });
                        for (let i = 0; i < data["brands"].length; i++) {
                            boxSubcategoryBrands.innerHTML += tmplBrandsSubcategory.replace("${img_brand_subcategory}",data["brands"][i]['image'])
                                .replace("${name_brand_subcategory}",data["brands"][i]['name'])
                                .replace("${data-brand-or-subcategory}","brands")
                                .replace("${data-category-id2}",`${categoryId}`)
                                .replace("${id-brand-or-subcategory}",data["brands"][i]['id'])
                        }
                    }
                });
            }, 400);
        });
    });

    // Обработчик клика на .substrate-category
    substrateCategory.addEventListener("click", function(event) {
        if (event.target === substrateCategory) {
            defaultStyleWindow();
        }
    });

    // Обработчик клика на .substrate-category-closeIcon
    closeIcon.addEventListener("click", function() {
        defaultStyleWindow();
    });
});






//2 блок каталога
function createCatalog(event) {
    const categoryNameElement = document.getElementById("category-name2");
    const boxSubcategoryBrands2 = document.getElementById("box-subcategory-brands2");
    const tmplBrandsSubcategory2 = document.getElementById("tmpl-brand-subcategory2").innerHTML;
    const categoryBoxBrandsBoxBrand = document.querySelectorAll(".category-boxBrands-box-brand");

    //Очищаем стили
    categoryBoxBrandsBoxBrand.forEach(function(brand) {
        brand.style.color = "";
    });

    // Получаем цель (элемент, на котором произошел клик)
    const clickedElement = event.currentTarget;

    //Активный элемент стили
    clickedElement.style.color = "rgb(64, 64, 64)";

    // Находим все элементы с классом "textCategoryBar2"
    const textCategoryBar2Elements = document.querySelectorAll(".textCategoryBar22");

    // Скрываем все элементы с классом "textCategoryBar2"
    textCategoryBar2Elements.forEach(function (element) {
        element.style.display = "none";
    });

    // Скрываем .category-boxBrands2
    categoryBoxBrands2.style.left = "284px";
    setTimeout(() => {
        categoryBoxBrands2.style.display = "none";
    }, 400);

    // Отображаем только элемент, на который кликнули
    const textCategoryBar2 = clickedElement.querySelector(".textCategoryBar22");
    textCategoryBar2.style.display = "block";

    // показываем .category-boxBrands2
    setTimeout(() => {
        categoryBoxBrands2.style.display = "block";
        setTimeout(() => {
            categoryBoxBrands2.style.left = "544px";
        },10);
    }, 400);

    // Получите name элемента из атрибута data-brand-or-subcategory
    const nameBrandOrSubcategory = clickedElement.getAttribute("data-brand-or-subcategory");
    // Получите ID выбранной категории
    const categoryId = clickedElement.getAttribute("data-category-id2");
    // Получите ID выбранной субкатегории или бренда
    const subcategoryOrBrandId = clickedElement.getAttribute("id-brand-or-subcategory");

    setTimeout(function() {

     // Название бокса
    categoryNameElement.textContent = clickedElement.textContent.replace('>', '');

    if (nameBrandOrSubcategory =="subcategories") {
        axios.get(`/get-brands-and-products/${categoryId}/${subcategoryOrBrandId}`)
            .then(function (response) {
                const data = response.data;
                console.log(data)
                // очищаем контейнер
                boxSubcategoryBrands2.innerHTML = '';
                data["brands"].sort((a, b) => {
                    return a['id'] - b['id'];
                });
                for (let i = 0; i < data["brands"].length; i++) {
                    // Получите полный текст
                    let fullName = data["brands"][i]['name'];

                    // Обрежьте текст до 21 символа
                    let truncatedName = fullName.slice(0, 23);

                    // Добавьте обрезанный текст в элемент
                    boxSubcategoryBrands2.innerHTML += tmplBrandsSubcategory2.replace("${name_brand_subcategory2}", truncatedName)
                     .replace("${img_brand_subcategory2}",data["brands"][i]['image'])
                }

    });
    }else if (nameBrandOrSubcategory =="brands"){
        axios.get(`/get-brands-and-products2/${categoryId}/${subcategoryOrBrandId}`)
            .then(function (response) {
                const data = response.data;
                // очищаем контейнер
                boxSubcategoryBrands2.innerHTML = '';
                data["products"].sort((a, b) => {
                    return a['id'] - b['id'];
                });
                for (let i = 0; i < data["products"].length; i++) {
                    // Получите полный текст
                    let fullName = data["products"][i]['name'];

                    // Обрежьте текст до 21 символа
                    let truncatedName = fullName.slice(0, 23);

                    // Добавьте обрезанный текст в элемент
                    boxSubcategoryBrands2.innerHTML += tmplBrandsSubcategory2.replace("${name_brand_subcategory2}", truncatedName)
                     .replace("${img_brand_subcategory2}",data["products"][i]['image'])
                }
            });

    }
    }, 400);
}

// Подсказкак при большом экране для категорий
function helperBigWindow() {
    // Получаем все элементы с классом .box-category-img-hover
    const boxCategoryImgHovers = document.querySelectorAll('.box-category-img-hover');
    const textCategoryBarElements = document.querySelectorAll('.textCategoryBar');

    if (isOpen === false) {
        // Перебираем все элементы и устанавливаем атрибут title для каждого
        boxCategoryImgHovers.forEach((boxCategoryImgHover, index) => {
            const categoryName = textCategoryBarElements[index].textContent;
            boxCategoryImgHover.title = categoryName;
        });
    } else {
        // Если isOpen === true, то удаляем атрибут title для всех элементов
        boxCategoryImgHovers.forEach(boxCategoryImgHover => {
            boxCategoryImgHover.removeAttribute('title');
        });
    }
}


//Получение isOpen
function getIsOpen() {
    const local = localStorage.getItem('isOpen');
    let result = JSON.parse(local);
    return result;
}

//Большой экран стили нажатие на каталог
function styleBigWindowCatalogActive() {
    leftBox3.style.width = "236px";
    leftBox3.style.zIndex = 10;
    textBars.forEach(element => element.style.opacity = 1);
    leftBoxContainer.style.padding = "76px 24px 68px 24px";
    phoneChatBox.style.width = "236px";
    phoneChatBox.style.marginBottom = "0px";
    phoneChatBox2.style.width = "188px";
    phoneChatBox2.style.height = "40px";
    phoneChatBox2.style.margin = "24px 0 0 24px";
    phoneChatBox2.style.flexDirection = "";
    phoneBox.style.marginLeft = "22px";
    textPhoneBox.style.display = "block";
    chatBox.style.margin = "0px 22px 0px 0px";
    imgPhoneBox.style.margin = "0px 10px 0px 0px";
    phoneChatLine.style.height = "24px";
    phoneChatLine.style.width = "1px";
    logoMin.style.width = "236px";
    logoMin2.style.display = "none";
    setTimeout(() => {
        logoMin3.style.display = "block";
        setTimeout(() => {
        logoMin3.style.opacity = 1;
        }, 100);
    }, 200);
    categoryBoxBrands.style.top = "24px"
    categoryBoxBrands2.style.top = "24px"
}


//Стили для большого экрана неактивный каталог
function styleBigWindowCatalogNoActive() {
    leftBox3.style.width = "64px";
    leftBox3.style.zIndex = 0;
    textBars.forEach(element => element.style.opacity = 0);
    leftBoxContainer.style.padding = "74px 12px 78px";
    phoneChatBox.style.width = "64px";
    phoneChatBox.style.marginBottom = "16px";
    phoneChatBox2.style.width = "40px";
    phoneChatBox2.style.height = "auto";
    phoneChatBox2.style.margin = "12px";
    phoneChatBox2.style.flexDirection = "column";
    phoneBox.style.marginLeft = "0px";
    textPhoneBox.style.display = "none";
    chatBox.style.margin = "12px 0px";
    imgPhoneBox.style.margin = "12px 0px";
    phoneChatLine.style.height = "1px";
    phoneChatLine.style.width = "24px";
    logoMin.style.width = "64px";
    logoMin2.style.display = "block";
    logoMin3.style.display = "none";
    logoMin3.style.opacity = 0;
    categoryBoxBrands.style.top = "98px"
    categoryBoxBrands2.style.top = "98px"
}


//Дефолтные значения при закрытии каталога и кнопки close
function defaultStyleWindow() {
    // Возвращаем стили всех .box-category к исходным значениям
    boxCategories.forEach(function(category) {
        category.querySelector(".textCategoryBar").style.color = "";
        category.querySelector(".box-category-img-hover").style.opacity = "";
        category.querySelector(".textCategoryBar2").style.display = "none";
    });

    // Скрываем .categoryBoxBrands2
    categoryBoxBrands2.style.left = "284px";
    categoryBoxBrands2.style.display = "none";

    if (getIsOpen() === false) {
        disableTransition()
        styleBigWindowCatalogNoActive()
        setTimeout(() => {
            enableTransition(); // Включаем анимацию после применения стилей
        }, 700);
    }


    // Скрываем .substrate-category и возвращаем стиль z-index для .left-box-1 и .left-box-2
    substrateCategory.style.display = "none";
    leftBox.style.removeProperty("z-index");

    // Скрываем .category-boxBrands и возвращаем на исходное место
    categoryBoxBrands.style.left = "24px";
    categoryBoxBrands.style.display = "none";
}




