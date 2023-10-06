<div class="card">
    <div class="card-top-container flex center">
        <div class="card-box-dinamic">
            <div class="card-hiden-img flex center">
                @foreach(array_slice(json_decode($product->image, true), 0, 2) as $imagePath)
                    <div class="flex center" style="width: 150px; height: 150px;">
                        <img  src="{{ Storage::url($imagePath) }}">
                    </div>
                @endforeach
            </div>
        </div>
        @if(count(json_decode($product->image, true)) > 1)
            <div class="bar">
                <span class="bar-indicator"></span>
            </div>
        @endif
    </div>

    <div class="card-down-container flex column">
        <p style="font-size: 14px;">{{ $product->name }}</p>
        <div class="card-raiting-reviews flex center">
            <img src="img/Star.svg" alt="">
            <p style="margin-left: 3px;">4.5</p>
            <p style="margin-left: 8px; color: #8e8e93;; font-size: 12px; font-weight: 400;">35</p>
            <p style="margin-left: 3px;  color: #8e8e93;; font-size: 12px; font-weight: 400;">Отзывов</p>
        </div>

        <div class="card-cashback flex center">
            @foreach ($product->cryptocurrencies as $cryptocurrency)
            <div class="container-cashback flex center">
                <div class="container-cashback-percent">
                    <p style="font-size: 12px; color: #ffffff; font-weight: 500;">{{ number_format($product->cashbacks->first()->cashback_percentage, 0) }}%</p>
                </div>
                <p style="margin-left: 3px;">+{{ $product->calculateCashbackAmount($cryptocurrency->id) }}</p>
                <img style="margin:0 3px;" src="{{ Storage::url($cryptocurrency->image) }}" alt="">
            </div>
            @endforeach
        </div>

        <div class="price-button flex center">
            <div  class="card-price flex center">
                <p style="margin-right: 8px; font-size: 13px;
                                                            line-height: 2rem;
                                                            font-weight: 400;
                                                            color: #8e8e93;
                                                            text-decoration: line-through;">20 990</p>
                <p style="font-size: 19px; font-weight: 600; margin-right: 8px;">{{ $product->price }} ₽</p>
            </div>
            <button class="btn-card">+</button>
        </div>

    </div>

</div>





























{{--<div class="card mx-4 my-4" style="width: 18rem;">--}}
{{--    <div class="d-flex justify-content-center" style="height: 250px; width: 100%; overflow: hidden;">--}}
{{--        <img class="card-img-top p-3" src="{{ Storage::url($product->image) }}" alt="Изображение товара" style="width: 68%;">--}}
{{--        @if($product->isNew())--}}
{{--            <span class="badge bg-primary position-absolute top-50 start-0 translate-middle-y">Новинка</span>--}}
{{--        @endif--}}
{{--        @if($product->isHit())--}}
{{--            <span class="badge bg-danger position-absolute top-0 start-0">Хит продаж</span>--}}
{{--        @endif--}}
{{--        @if($product->isRecommend())--}}
{{--            <span class="badge bg-success position-absolute top-0 end-0">Рекомендуем</span>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <p class="card-title">{{ $product->name }}</p>--}}
{{--        <p class="card-text"><b>{{ $product->price }} ₽</b></p>--}}
{{--        <p class="card-text">{{ $product->category->name }}</p>--}}
{{--        @foreach ($product->cryptocurrencies as $cryptocurrency)--}}
{{--            <div class="d-flex justify-content-end m-2">--}}
{{--                <img style="height: 30px; width: 30px;" src="{{ Storage::url($cryptocurrency->image) }}" alt="{{ $cryptocurrency->name }}">--}}
{{--                <p class="card-text">{{ $product->calculateCashbackAmount($cryptocurrency->id) }} {{$cryptocurrency->small_name}}</p>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <div class="card-footer d-flex justify-content-between">--}}
{{--        <form action="{{ route('basket-add', $product->id) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @if($product->isAvailable())--}}
{{--                <button type="submit" class="btn btn-primary">В корзину</button>--}}
{{--            @else--}}
{{--                <p class="card-text"> Нет в наличии </p>--}}
{{--            @endif--}}
{{--        </form>--}}
{{--        <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-primary border border-secondary text-secondary bg-white">Подробнее</a>--}}
{{--    </div>--}}
{{--</div>--}}
