
    <div class="card mx-4 my-4" style="width: 18rem;">

            <img src="https://cdn.citilink.ru/55EhmNN-dZApVjnRvWgpDq8AOSeE-cqdeVx3EkPdnmk/resizing_type:fit/gravity:sm/width:1200/height:1200/plain/items/1885660_v01_b.jpg" class="card-img-top" alt="...">

        <div class="card-body">
            <h5 class="card-title">{{$product -> name}}</h5>
            <p class="card-text">{{$product -> price}} руб.</p>
            <p class="card-text"> {{ $product->category->name }} </p>
            <div>
                <form action="{{ route('basket-add', $product->id) }}" method="POST">
                   @csrf
                    <button type="submit" class="btn btn-primary">В корзину</button>
                    <a href="{{ route('product', [$product->category->code, $product->code ]) }}" class="btn btn-primary border border-secondary text-secondary bg-white">Подробнее</a>
                </form>
            </div>
        </div>
    </div>

