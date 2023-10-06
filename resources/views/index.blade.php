@extends('layouts.master')
@section('title', 'Главная страница')

@section('content')
    <!-- Карусель -->
    <div class="carousel-container">
        <div class="carousel-overlay">
            <div class="carousel-arrow left-arrow">
                <span>&lt;</span>
            </div>
            <div class="carousel-slide">
                <img src="img/Карусель1.webp" alt="Изображение 1">
                <img src="img/Карусель2.webp" alt="Изображение 2">
                <img src="img/Карусель3.webp" alt="Изображение 3">
                <!-- Добавьте дополнительные изображения по мере необходимости -->
            </div>
            <div class="carousel-arrow right-arrow">
                <span>&gt;</span>
            </div>
        </div>
        <div class="carousel-dots">
            <!-- Точки будут добавлены с использованием JavaScript -->
        </div>
    </div>


    <!-- Категории товаров -->
    <div style="margin: 65px 0 40px 0">
        <p style="font-size: 25px; font-weight: 600; line-height: 33px; letter-spacing: -.6px; margin-left: 2px; margin-bottom: 20px;">Каталог</p>
        <div class="box-category-center flex">
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Телефоны</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Планшеты</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Компьютеры</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Смарт-часы</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Наушники</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Техника для дома</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Колонки</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Игровые консоли</p>
            </div>
            <div class="card-box flex center">
                <div class="card-box-img">
                    <img src="" alt="">
                </div>
                <p style="margin:0 15px 0 106px;">Аксессуары</p>
            </div>
        </div>
    </div>


    <!-- популярные бренды -->
    <div style="margin: 65px 0 40px 0">
        <p style="font-size: 25px; font-weight: 600; line-height: 33px; letter-spacing: -.6px; margin-left: 2px; margin-bottom: 20px;">Популярные бренды</p>
        <div class="brands">
            <div class="brands-slider">
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
                <div class="clider1"></div>
            </div>
            <button id="prevBtn"><</button>
            <button id="nextBtn">></button>
        </div>
    </div>


    <!-- Хиты продаж -->
    <div style="margin: 65px 0 40px 0">
        <p style="font-size: 25px; font-weight: 600; line-height: 33px; letter-spacing: -.6px; margin-left: 2px; margin-bottom: 20px;">Хиты продаж</p>
        <div class="cards-hit">
            <div class="cards-slider">
                @foreach($products as $product)
                    @include('layouts.card', $product)
                @endforeach
            </div>
            <button id="prevBtn2"><</button>
            <button id="nextBtn2">></button>
        </div>
    </div>


@endsection










{{--<h1 class="text-white m-3">Главная страница</h1>--}}
{{--<form action="{{ route('index') }}" method="GET" class="form-inline d-flex flex-wrap m-3">--}}
{{--    <div class="form-group">--}}
{{--        <label for="price_from">Цена от:</label>--}}
{{--        <input type="number" class="form-control-sm mx-2" id="price_from" name="price_from" value="{{ request()->price_from }}">--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label for="price_to">Цена до:</label>--}}
{{--        <input type="number" class="form-control-sm mx-2" id="price_to" name="price_to" value="{{ request()->price_to }}">--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <div class="form-check form-check-inline">--}}
{{--            <input type="checkbox" class="form-check-input" id="hit" name="hit" @if(request()->has('hit')) checked @endif>--}}
{{--            <label class="form-check-label" for="hit">Хит</label>--}}
{{--        </div>--}}

{{--        <div class="form-check form-check-inline">--}}
{{--            <input type="checkbox" class="form-check-input" id="new" name="new" @if(request()->has('new')) checked @endif>--}}
{{--            <label class="form-check-label" for="new">Новинка</label>--}}
{{--        </div>--}}

{{--        <div class="form-check form-check-inline">--}}
{{--            <input type="checkbox" class="form-check-input" id="recommend" name="recommend" @if(request()->has('recommend')) checked @endif>--}}
{{--            <label class="form-check-label" for="recommend">Рекомендуем</label>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <button type="submit" class="btn btn-primary mx-2">Фильтр</button>--}}
{{--    <a href="{{ route('index') }}" type="reset" class="btn btn-secondary mx-2">Сбросить</a>--}}
{{--</form>--}}
{{--<div class="d-flex flex-wrap justify-content-start">--}}
{{--    @foreach($products as $product)--}}
{{--        @include('layouts.card', $product)--}}
{{--    @endforeach--}}
{{--</div>--}}
{{-- Пагинация для продуктов --}}
{{--<div id="pagination" class="d-flex justify-content-center mt-3">--}}
{{--    {{ $products->links() }}--}}
{{--</div>--}}
