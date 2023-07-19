<div class="card mx-4 my-4" style="width: 18rem;">
    <div class="d-flex justify-content-center" style="height: 250px; width: 100%; overflow: hidden;">
        <img class="card-img-top" src="{{ Storage::url($product->image) }}" alt="Изображение товара" style="width: 68%;">
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
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{$product->price}} руб.</p>
        <p class="card-text">{{$product->category->name}}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <form action="{{ route('basket-add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">В корзину</button>
        </form>
        <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-primary border border-secondary text-secondary bg-white">Подробнее</a>
    </div>
</div>

