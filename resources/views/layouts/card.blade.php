<div class="card mx-4 my-4" style="width: 18rem;">
    <div class="d-flex justify-content-center" style="height: 250px; width: 100%; overflow: hidden;">
        <img class="card-img-top p-3" src="{{ Storage::url($product->image) }}" alt="Изображение товара" style="width: 68%;">
        @if($product->isNew())
            <span class="badge bg-primary position-absolute top-50 start-0 translate-middle-y">Новинка</span>
        @endif
        @if($product->isHit())
            <span class="badge bg-danger position-absolute top-0 start-0">Хит продаж</span>
        @endif
        @if($product->isRecommend())
            <span class="badge bg-success position-absolute top-0 end-0">Рекомендуем</span>
        @endif
    </div>
    <div class="card-body">
        <p class="card-title">{{$product->name}}</p>
        <p class="card-text"><b>{{ $product->price }} ₽</b></p>
        <p class="card-text">{{$product->category->name}}</p>
    </div>
    <div class="d-flex justify-content-end m-2">
        <img style="height: 30px; width: 30px;" src="{{ Storage::url($product->cryptocurrencies->first()->image) }}" >
        <p class="card-text">{{$product->calculateCashbackAmount()}}</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <form action="{{ route('basket-add', $product->id) }}" method="POST">
            @csrf
            @if($product->isAvailable())
                <button type="submit" class="btn btn-primary">В корзину</button>
            @else
                <p class="card-text"> Нет в наличии </p>
            @endif
        </form>
        <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-primary border border-secondary text-secondary bg-white">Подробнее</a>
    </div>
</div>

