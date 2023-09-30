const categoryBoxBrands2 = document.querySelector(".category-boxBrands2");
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




//Увеличение или уменьшение рабочей области

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
const phoneChatBox = document.querySelector(".phoneChatBox");
const phoneChatBox2 = document.querySelector(".phoneChatBox2");
const phoneBox = document.querySelector(".phoneBox");
const imgPhoneBox = document.getElementById("imgPhoneBox");
const textPhoneBox = document.getElementById("textPhoneBox");
const chatBox = document.querySelector(".chatBox");
const phoneChatLine = document.querySelector(".phoneChatLine");

let isOpen = false;

maxWindowButton.addEventListener("click", () => {
    if (isOpen) {
        logoMin.style.display = "none";
        logoMin2.style.opacity = 0;
        leftBox3.style.width = "236px";
        leftBoxContainer.style.padding = "24px";
        imgLogo1.style.margin = "38px 0px 0px 30px";
        textBars.forEach(element => element.style.opacity = 1);
        containerContent.style.margin="0px 384px 0px 284px"
        containerCenterTop.style.left="284px"
        isOpenIcon.style.display = "block";
        noIsOpenIcon.style.display = "none";
        footer.style.left="284px";
        phoneChatBox.style.width="236px";
        phoneChatBox.style.marginBottom="0px";
        phoneChatBox2.style.width="188px";
        phoneChatBox2.style.height="40px";
        phoneChatBox2.style.margin="24px 0 0 24px";
        phoneChatBox2.style.flexDirection = "";
        phoneBox.style.marginLeft="22px";
        textPhoneBox.style.display="block";
        chatBox.style.margin="0px 22px 0px 0px";
        imgPhoneBox.style.margin="0px 10px 0px 0px";
        phoneChatLine.style.height="24px";
        phoneChatLine.style.width="1px";


        // Поставим команду с задержкой, чтобы она выполнилась после остальных
        setTimeout(() => {
            leftBox2.classList.remove("hidden2")
            leftBox.style.height = '82px';
            imgLogo1.style.opacity = 1;
            ;

        }, 500);
    } else {
        containerContent.style.margin="0px 384px 0px 112px"
        leftBox.style.height = '0px';
        leftBox2.classList.add("hidden2");
        leftBox3.style.width = "64px";
        leftBoxContainer.style.padding = "74px 12px 0px 12px";
        imgLogo1.style.opacity = 0;
        imgLogo1.style.margin = "0px";
        textBars.forEach(element => element.style.opacity = 0);
        containerCenterTop.style.left="112px"
        isOpenIcon.style.display = "none";
        noIsOpenIcon.style.display = "block";
        footer.style.left="112px";
        phoneChatBox.style.width="64px";
        phoneChatBox.style.marginBottom="16px";
        phoneChatBox2.style.width="40px";
        phoneChatBox2.style.height="auto";
        phoneChatBox2.style.margin="12px";
        phoneChatBox2.style.flexDirection="column";
        phoneBox.style.marginLeft="0px";
        textPhoneBox.style.display="none";
        chatBox.style.margin="12px 0px";
        imgPhoneBox.style.margin="12px 0px";
        phoneChatLine.style.height="1px";
        phoneChatLine.style.width="24px";
        setTimeout(() => {
        logoMin.style.display = "flex";
        }, 400);
             setTimeout(() => {
                logoMin2.style.opacity = 1;
                 }, 500);
    }

    isOpen = !isOpen;
});



//подложка под категории и меню
document.addEventListener("DOMContentLoaded", function() {
    const boxCategories = document.querySelectorAll(".box-category");
    const substrateCategory = document.querySelector(".substrate-category");
    const closeIcon = document.querySelector(".substrate-category-closeIcon");
    const leftBox = document.querySelector(".left-box");
    const categoryBoxBrands = document.querySelector(".category-boxBrands");
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



            // // Проверяем стиль элемента categoryBoxBrands2
            // if (categoryBoxBrands2.style.display === "block") {
            //     // Скрываем .category-boxBrands2
            //     categoryBoxBrands2.style.left = "284px";
            //     setTimeout(() => {
            //         categoryBoxBrands2.style.display = "none";
            //     }, 400);
            //     // Скрываем .category-boxBrands
            //
            //     setTimeout(() => {
            //         categoryBoxBrands.style.left = "24px";
            //     }, 400);
            //
            //     setTimeout(() => {
            //         categoryBoxBrands.style.display = "none";
            //     }, 800);
            // }else {
            //     // Скрываем .category-boxBrands
            //     categoryBoxBrands.style.left = "24px";
            //     setTimeout(() => {
            //         categoryBoxBrands.style.display = "none";
            //     }, 400);
            // }



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
                    console.log(data)
                    // очищаем контейнер
                    boxSubcategoryBrands.innerHTML = '';
                    if (data["subcategories"].length > 0) {
                        data["subcategories"].sort((a, b) => {
                            return a['id'] - b['id'];
                        });
                        for (let i = 0; i < data["subcategories"].length; i++) {
                            boxSubcategoryBrands.innerHTML += tmplBrandsSubcategory.replace("${img_brand_subcategory}",data["subcategories"][i]['image'])
                                .replace("${name_brand_subcategory}",data["subcategories"][i]['name'])
                        }
                    }else {
                        data["brands"].sort((a, b) => {
                            return a['id'] - b['id'];
                        });
                        for (let i = 0; i < data["brands"].length; i++) {
                            boxSubcategoryBrands.innerHTML += tmplBrandsSubcategory.replace("${img_brand_subcategory}",data["brands"][i]['image'])
                                .replace("${name_brand_subcategory}",data["brands"][i]['name'])
                        }
                    }
                });
            }, 400);
        });
    });

    // Обработчик клика на .substrate-category
    substrateCategory.addEventListener("click", function(event) {
        if (event.target === substrateCategory) {
            // Возвращаем стили всех .box-category к исходным значениям
            boxCategories.forEach(function(category) {
                category.querySelector(".textCategoryBar").style.color = "";
                category.querySelector(".box-category-img-hover").style.opacity = "";
                category.querySelector(".textCategoryBar2").style.display = "none";
            });

            // Скрываем .categoryBoxBrands2
            categoryBoxBrands2.style.display = "none";
            categoryBoxBrands2.style.left = "284px";

            // Скрываем .substrate-category и возвращаем стиль z-index для .left-box-1 и .left-box-2
            substrateCategory.style.display = "none";
            leftBox.style.removeProperty("z-index");

            // Скрываем .category-boxBrands и возвращаем на исходное место
            categoryBoxBrands.style.left = "24px";
            categoryBoxBrands.style.display = "none";

        }
    });

    // Обработчик клика на .substrate-category-closeIcon
    closeIcon.addEventListener("click", function() {
        // Возвращаем стили всех .box-category к исходным значениям
        boxCategories.forEach(function(category) {
            category.querySelector(".textCategoryBar").style.color = "";
            category.querySelector(".box-category-img-hover").style.opacity = "";
            category.querySelector(".textCategoryBar2").style.display = "none";
        });

        // Скрываем .categoryBoxBrands2
        categoryBoxBrands2.style.left = "284px";
        categoryBoxBrands2.style.display = "none";


        // Скрываем .substrate-category и возвращаем стиль z-index для .left-box-1 и .left-box-2
        substrateCategory.style.display = "none";
        leftBox.style.removeProperty("z-index");

        // Скрываем .category-boxBrands и возвращаем на исходное место
        categoryBoxBrands.style.left = "24px";
        categoryBoxBrands.style.display = "none";

    });
});






//2 блок каталога
function createCatalog(event) {
    // Получаем цель (элемент, на котором произошел клик)
    const clickedElement = event.currentTarget;

    // Находим все элементы с классом "textCategoryBar2"
    const textCategoryBar2Elements = document.querySelectorAll(".textCategoryBar22");

    // Скрываем все элементы с классом "textCategoryBar2"
    textCategoryBar2Elements.forEach(function (element) {
        element.style.display = "none";
    });

    // Скрываем .category-boxBrands2
    categoryBoxBrands2.style.left = "284px";
    setTimeout(() => {
        categoryBoxBrands.style.display = "none";
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



}







