<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>5G Store: @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
    <div class="main">
        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
        {{-- подложка--}}
        <div class="substrate-category" style="display: none">
            <div class="substrate-category-closeIcon flex center center2">
                <i class="material-icons" style="display: block; color: rgb(64,64,64) ">close</i>
            </div>

        </div>

        {{-- подложка2--}}
        <div   class="substrate-category2" style="display: none" id="substrate-category2">

        </div>

        {{-- бокс для продуктов--}}
        <div class="boxForProduct" style="display: none">

        </div>



        <div class="category-boxBrands" style="display: none; left: 24px;">
            <div class="category-boxBrands-box" style="padding: 24px">
                <p id="category-name" style="font-size: 17px; color: rgb(64, 64, 64);"></p>
                <div style="width: 100%; height: 1px; background-color:#E0E0E0; margin-top: 16px;"></div>
                <div id="box-subcategory-brands">
                </div>
            </div>

        </div>

        <div style="display: none; left: 284px;" class="category-boxBrands2">
            <div class="category-boxBrands-box2" style="padding: 24px">
                <p id="category-name2" style="font-size: 17px; color: rgb(64, 64, 64);"></p>
                <div style="width: 100%; height: 1px; background-color:#E0E0E0; margin-top: 16px;"></div>
                <div id="box-subcategory-brands2">
                </div>
            </div>
        </div>

        <!-- Левый контейнер -->
        <div class="left-box">



            <a href="{{ route('index') }}">
                <div class="logomin flex  center center2">
                    <img class="logomin2" src="{{ asset('img/logomin.svg') }}" alt="">
                    <img style="display: none;  opacity: 0 " class="logomin3" src="{{ asset('img/5glogotop.svg') }}" alt="">
                </div>
            </a>


            <!-- телефон и чат -->
            <div class="phoneChatBox">
                <div class="phoneChatBox2 flex center between">
                    <a href="tel:+79256358022">
                        <div style="margin-left: 22px; cursor: pointer;" class="phoneBox flex center">
                            <svg id="imgPhoneBox" style="margin-right: 10px; height: 14px;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#A5A5A5}</style><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"/></svg>
                            <p id="textPhoneBox" style="color: #A5A5A5; font-size: 12px; font-weight: 400;">Позвонить</p>
                        </div>
                    </a>
                    <div class="phoneChatLine"></div>
                    <div style="margin-right: 22px; cursor: pointer;" class="chatBox flex center">
                        <!-- <img src="img/shatIcon.svg" alt=""> -->
                        <svg id="imgChatBox" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#A5A5A5}</style><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>
                    </div>
                </div>
            </div>

            <a href="{{ route('index') }}">
                <div class="left-box-1 transition" style="height: 82px;">
                        <img id="left-box-1-img" style="margin: 38px 0 0 30px;" src="{{ asset('img/5glogotop.svg') }}" alt="">
                </div>
            </a>
            {{-- Категории--}}
            <div class="left-box-2">

                <div class="left-box-container" >
                    @foreach($categories as $category)
                    <div class="box-category flex center between" style="margin-bottom: 20px;" data-category-id = "{{ $category->id }}">
                        <div class="flex center">
                            <div class="box-category-img flex center center2" style=" margin-right: 10px; ">
                                <img class="" style="height: 30px"
                                     src="{{ Storage::url($category->image) }} ">
                                <div class="box-category-img-hover"></div>
                            </div>
                            <p style="transition: all 0.1s ease-out;" class="textCategoryBar">{{$category->name}}</p>
                        </div>
                        <p style="display: none; transition: all 0.1s ease-out; color: #1A74FF; margin-left: 6px;" class="textCategoryBar2">></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Центральная часть вверх  -->
        <div class="center-top">
            <div class="search-box">
                <div class="flex center between" style="margin: 24px 30px 0 24px;">
                    <div class="location">
                        <img src="{{ asset('img/location.svg') }}" alt="">
                        <a href="">
                            <p>Москва</p>
                        </a>
                    </div>
                    <div class="flex center">
                        <i style="margin-right: 12px;" class="material-icons">favorite_border</i>
                        <div id="maxWindow">
                            <i id="noIsOpenIcon" class="material-icons" style="display: none;">zoom_in_map</i>
                            <i id="isOpenIcon" class="material-icons" style="display: block;">zoom_out_map</i>
                            <!-- <svg id="noIsOpenIcon" style="display: none;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#c0c0c0}</style><path d="M200 288H88c-21.4 0-32.1 25.8-17 41l32.9 31-99.2 99.3c-6.2 6.2-6.2 16.4 0 22.6l25.4 25.4c6.2 6.2 16.4 6.2 22.6 0L152 408l31.1 33c15.1 15.1 40.9 4.4 40.9-17V312c0-13.3-10.7-24-24-24zm112-64h112c21.4 0 32.1-25.9 17-41l-33-31 99.3-99.3c6.2-6.2 6.2-16.4 0-22.6L481.9 4.7c-6.2-6.2-16.4-6.2-22.6 0L360 104l-31.1-33C313.8 55.9 288 66.6 288 88v112c0 13.3 10.7 24 24 24zm96 136l33-31.1c15.1-15.1 4.4-40.9-17-40.9H312c-13.3 0-24 10.7-24 24v112c0 21.4 25.9 32.1 41 17l31-32.9 99.3 99.3c6.2 6.2 16.4 6.2 22.6 0l25.4-25.4c6.2-6.2 6.2-16.4 0-22.6L408 360zM183 71.1L152 104 52.7 4.7c-6.2-6.2-16.4-6.2-22.6 0L4.7 30.1c-6.2 6.2-6.2 16.4 0 22.6L104 152l-33 31.1C55.9 198.2 66.6 224 88 224h112c13.3 0 24-10.7 24-24V88c0-21.3-25.9-32-41-16.9z"/></svg>
                            <svg id="isOpenIcon" style="display: block;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><style>svg{fill:#c0c0c0}</style><path d="M448 344v112a23.94 23.94 0 0 1-24 24H312c-21.39 0-32.09-25.9-17-41l36.2-36.2L224 295.6 116.77 402.9 153 439c15.09 15.1 4.39 41-17 41H24a23.94 23.94 0 0 1-24-24V344c0-21.4 25.89-32.1 41-17l36.19 36.2L184.46 256 77.18 148.7 41 185c-15.1 15.1-41 4.4-41-17V56a23.94 23.94 0 0 1 24-24h112c21.39 0 32.09 25.9 17 41l-36.2 36.2L224 216.4l107.23-107.3L295 73c-15.09-15.1-4.39-41 17-41h112a23.94 23.94 0 0 1 24 24v112c0 21.4-25.89 32.1-41 17l-36.19-36.2L263.54 256l107.28 107.3L407 327.1c15.1-15.2 41-4.5 41 16.9z"/></svg> -->
                        </div>
                    </div>
                </div>

                <div class="search flex center">
                    <img style="margin-left: 24px;" src="{{ asset('img/search.svg') }}" >
                    <input type="text" placeholder="Найти товар">
                </div>
            </div>
        </div>





        <!-- Правый контейнер -->
        <div class="rigth-box">
            <div class="rigth-box-1">
                <div class="rigth-box-1-container flex">
                    <img src="{{ asset('img/wallet5g.png') }}" alt="">
                    <div class="rigth-box-1-container2">
                        <p>Войдите в систему, чтобы получать кэшбэк в критовалюте</p>
                        <button class="rigth-box-1-container-button" href="">Войти</button>
                    </div>
                </div>
            </div>
            <div class="rigth-box-2">
                <div class="rigth-box-2-container " style="margin: 24px;">
                    <div class="rigth-box-2-container-menu">

                        <button id="btn-menu-1" class="active-menu" onclick="showCryptoContent()">Криптовалюты</button>
                        <button id="btn-menu-2" class="inactive-menu" onclick="showWalletContent()">Кошелек</button>
                    </div>
                    <div class="rigth-box-2-container-menu-content">
                        <div style="margin-top: 8px;"  id="crypto-content">
                            <!-- Ваш контент для криптовалют -->

                            <div class="rigth-box-2-container-menu-content-item">
                                <img src="{{ asset('img/bitcoin1.svg') }}" alt="" class="bitcoin-icon">
                                <div class="rigth-box-2-container-menu-content-item-details">
                                    <p class="bitcoin-name">Биткоин</p>
                                    <p class="bitcoin-symbol">BTC</p>
                                </div>
                                <div class="rigth-box-2-container-menu-content-item-price">
                                    <p class="bitcoin-price">25 845,1 $</p>
                                    <p class="bitcoin-change">+0,87 %</p>
                                </div>
                            </div>

                            <div class="rigth-box-2-container-menu-content-item">
                                <img src="{{ asset('img/Ethereum1.svg') }}" alt="" class="bitcoin-icon">
                                <div class="rigth-box-2-container-menu-content-item-details">
                                    <p class="bitcoin-name">Эфириум</p>
                                    <p class="bitcoin-symbol">ETH</p>
                                </div>
                                <div class="rigth-box-2-container-menu-content-item-price">
                                    <p class="bitcoin-price">1 655,72 $</p>
                                    <p class="bitcoin-change">-1,27 %</p>
                                </div>
                            </div>

                            <div class="rigth-box-2-container-menu-content-item">
                                <img src="{{ asset('img/USDT.svg') }}" alt="" class="bitcoin-icon">
                                <div class="rigth-box-2-container-menu-content-item-details">
                                    <p class="bitcoin-name">Доллар </p>
                                    <p class="bitcoin-symbol">USDT</p>
                                </div>
                                <div class="rigth-box-2-container-menu-content-item-price">
                                    <p class="bitcoin-price">96,86 ₽</p>
                                    <p class="bitcoin-change">+5,12 %</p>
                                </div>
                            </div>

                            <div class="rigth-box-2-container-menu-content-item">
                                <img src="{{ asset('img/5G. COIN.png') }}" alt="" class="bitcoin-icon">
                                <div class="rigth-box-2-container-menu-content-item-details">
                                    <p class="bitcoin-name">5G coin</p>
                                    <p class="bitcoin-symbol">5Gcoin</p>
                                </div>
                                <div class="rigth-box-2-container-menu-content-item-price">
                                    <p class="bitcoin-price">1,08 $</p>
                                    <p class="bitcoin-change">+5,27 %</p>
                                </div>
                            </div>

                            <div  class="pagination">
                                <div class="pagination-circle active"></div>
                                <div class="pagination-circle"></div>
                                <div class="pagination-circle"></div>
                            </div>
                        </div>
                    </div>
                    <div id="wallet-content" style="display: none;">
                        <!-- Ваш контент для кошелька -->
                        <div class="rigth-box-2-container-wallet">
                            <div class="wallet-info-box flex column center">
                                <p style="color: #ADADAD; font-size: 11px; font-weight: 400; margin: 0;">Баланс</p>
                                <div>
                                    <label style="font-size: 22px; font-weight: 500; color: #404040;" for="currency">5.21</label>
                                    <div class="select-wrapper">
                                        <select id="currency">
                                            <option value="USDT">USDT</option>
                                            <option value="RUB">RUB</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                        <i class="fas fa-chevron-down"></i> <!-- Стрелочка вниз (Font Awesome) -->
                                    </div>
                                </div>
                            </div>
                            <div class="rigth-box-2-container-menu-content">
                                <div class="rigth-box-2-container-menu-content-item">
                                    <img src="{{ asset('img/5G. COIN.png') }}" alt="" class="bitcoin-icon">
                                    <div class="rigth-box-2-container-menu-content-item-details">
                                        <p class="bitcoin-name">5G coin</p>
                                        <p class="bitcoin-symbol">5Gcoin</p>
                                    </div>
                                    <div class="rigth-box-2-container-menu-content-item-price">
                                        <p class="bitcoin-price">5.0001</p>
                                        <p class="bitcoin-change">5.21 USDT</p>
                                    </div>
                                </div>
                                <div class="rigth-box-2-container-menu-content-item">
                                    <img src="{{ asset('img/bitcoin1.svg') }}" alt="" class="bitcoin-icon">
                                    <div class="rigth-box-2-container-menu-content-item-details">
                                        <p class="bitcoin-name">Биткоин</p>
                                        <p class="bitcoin-symbol">BTC</p>
                                    </div>
                                    <div class="rigth-box-2-container-menu-content-item-price">
                                        <p class="bitcoin-price">0.0000</p>
                                        <p class="bitcoin-change">0.00 USDT</p>
                                    </div>
                                </div>

                                <div class="rigth-box-2-container-menu-content-item">
                                    <img src="{{ asset('img/Ethereum1.svg') }}" alt="" class="bitcoin-icon">
                                    <div class="rigth-box-2-container-menu-content-item-details">
                                        <p class="bitcoin-name">Эфириум</p>
                                        <p class="bitcoin-symbol">ETH</p>
                                    </div>
                                    <div class="rigth-box-2-container-menu-content-item-price">
                                        <p class="bitcoin-price">0.0000</p>
                                        <p class="bitcoin-change">0.00 USDT</p>
                                    </div>
                                </div>
                                <div class="pagination">
                                    <div class="pagination-circle active"></div>
                                    <div class="pagination-circle"></div>
                                    <div class="pagination-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>


        <!-- Центральная часть основной контент -->
        <div class="container">
            <div class="container-content">
                <div class="container-content2">

                    @yield('content')

                </div>
            </div>
            <div class="container3">
                <div class="fotter-margin"></div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-box">
                <div class="footer-box-1">
                    <div class="footer-box-1-1">
                        <a href="">
                            <img src="{{ asset('img/Group 172.svg') }}" alt="">
                        </a>
                        <a href="" style="margin-left: 12px;">
                            <img src="{{ asset('img/Group 173.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="footer-box-1-2">
                        <a href="">
                            <img src="{{ asset('img/Group 171.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/Group 170.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/Group 167.svg') }}" alt="">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/yotube.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="footer-box-2">
                    <a href="#"><span>О компании</span></a>
                    <a href="#"><span>Доставка</span></a>
                    <a href="#"><span>Корпаративным клиентам</span></a>
                    <a href="#"><span>Гарантия</span></a>
                    <a href="#"><span>Условия обмена и возврата</span></a>
                    <a href="#"><span>Политика конфинденциальности</span></a>
                    <a href="#"><span>Контакты</span></a>
                    <a href="#"><span>Оплата</span></a>
                </div>
            </div>
        </div>
    </div>
{{--    шаблон для подкатегорий или брендов--}}
    <template id="tmpl-brand-subcategory">
        <div onclick="createCatalog(event)" style="margin-top: 20px" class="category-boxBrands-box-brand flex center between" data-brand-or-subcategory = "${data-brand-or-subcategory}" id-brand-or-subcategory = "${id-brand-or-subcategory}" data-category-id2 = "${data-category-id2}">
            <div class="flex center">
                <img style="height: 25px; margin-right: 10px;" src="{{ Storage::url('${img_brand_subcategory}') }}">
                <p class="category-boxBrands-text" style="font-weight: 400; ">${name_brand_subcategory}</p>
            </div>
            <p style="display: none; transition: all 0.1s ease-out; color: #1A74FF; margin-left: 6px;" class="textCategoryBar22">></p>
        </div>
    </template>

    <template id="tmpl-brand-subcategory2">
        <div  style="margin-top: 20px" class="category-boxBrands-box-brand flex center between">
            <div class="flex center">
                <img style="height: 25px; margin-right: 10px;" src="{{ Storage::url('${img_brand_subcategory2}') }}">
                <p class="category-boxBrands-text" style="font-weight: 400; ">${name_brand_subcategory2}</p>
            </div>
        </div>
    </template>
    {{--    шаблон для страницы продукта--}}
    <template id="tmpl-product">
        <div class="flex">
            <div>
                sdfsdfsdfs
            </div>
            <div>
                sdfsdsdf
            </div>
            <div id="closeIcon2"  class="substrate-category-closeIcon2 flex center center2">
                <i class="material-icons" style=" color: rgb(64,64,64) ">close</i>
            </div>
        </div>
    </template>

    <script src="/js/app.js"></script>
    @yield('js')
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
</body>
</html>




{{--<header class="p-3 text-bg-dark">--}}
{{--    <div class="container">--}}
{{--        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">--}}

{{--            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">--}}
{{--                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Начальная загрузка"><use xlink:href="#bootstrap"></use></svg>--}}
{{--            </a>--}}

{{--            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">--}}
{{--                <li><a href="{{ route('index') }}" class="nav-link px-2  text-secondary btn  @if(Route::currentRouteNamed('index')) text-white  @endif " style="vertical-align: inherit;">Главная страница</a></li>--}}
{{--                <li><a href="{{ route('categories') }}" class="nav-link px-2 text-secondary @if(Route::currentRouteNamed('categor*')) text-white  @endif" style="vertical-align: inherit;" style="vertical-align: inherit;">Категории</a></li>--}}
{{--                <li><a href="{{ route('basket') }}" class="nav-link px-2 text-secondary @if(Route::currentRouteNamed('basket*')) text-white  @endif" style="vertical-align: inherit;" style="vertical-align: inherit;">Корзина</a></li>--}}


{{--            </ul>--}}

{{--            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="{{ route('index') }}" method="GET">--}}
{{--                <input type="search" name="search" class="form-control form-control-dark text-bg-white" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">--}}

{{--            </form>--}}



{{--            <div class="text-end">--}}
{{--                @guest('web')--}}
{{--                    <a href="{{ route('login') }}" type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Войти</font></font></a>--}}
{{--                    <a href="{{ route('register') }}" type="button" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Зарегистрироваться</font></font></a>--}}
{{--                @endguest--}}

{{--                @auth('web')--}}
{{--                    <a href="{{ route('home') }}" type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Личный кабинет</font></font></a>--}}
{{--                    <a href="{{ route('logout') }}" type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выйти</font></font></a>--}}
{{--                @endauth--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}
{{--<main >--}}
{{--    --}}{{--    уведомление об удачном выполнении или добавлении--}}
{{--    @if(session()->has('success'))--}}
{{--        <div class="alert alert-success d-flex  align-items-center justify-content-center" role="alert">--}}
{{--            {{ session()->get('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    --}}{{--    уведомление об ошибке или удалении--}}
{{--    @if(session()->has('warning'))--}}
{{--        <div class="alert alert-danger d-flex  align-items-center justify-content-center" role="alert">--}}
{{--            {{ session() -> get('warning') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @yield('content')--}}




{{--</main>--}}
