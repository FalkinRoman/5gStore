@extends('layouts.master')
@section('title', 'Главная страница')

@section('content')

    <div class="d-flex justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Ваша корзина</span>

            </h4>
            <ul class="list-group mb-3">
                @foreach($order->products as $product)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="mr-3">
                            <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                <img class="" style="height: 70px"
                                     src="{{ Storage::url($product->image) }} ">
                            </a>
                        </div>
                        <div style="margin-left: 10px">
                            <h6 class="my-0">{{ $product->name }}</h6>
                            <small class="text-muted">{{ $product->description }}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="d-flex ml-3">
                                <form action="{{ route('basket-remove', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">-</button>
                                </form>
                                <form action="{{ route('basket-add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">+</button>
                                </form>
                                <div style="background-color: darkgrey; width: 30px;"
                                     class="d-flex ml-2 rounded-circle align-items-center justify-content-center text-white">{{ $product->pivot->count }}</div>
                            </div>
                            <div style="width: 90px; margin-left: 10px" class="d-flex ml-3 flex-column ">
                                <span class="text-muted">Цена:</span>
                                <span class="font-weight-bold">{{ $product->price }} руб.</span>
                            </div>
                            <div style="width: 100px;" class="d-flex ml-3 flex-column">
                                <span class="text-muted">Стоимость:</span>
                                <span class="font-weight-bold">{{ $product->getPriceForCount() }} руб.</span>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
            <h4 class="d-flex justify-content-end align-items-center mb-3">
                <span class="text-dark pr-3">Общая стоимость:</span>
                <span style="margin-left: 10px"

                      class="badge bg-primary rounded-pill">{{ $order->getFullPrice() }} руб.</span>

            </h4>
            <div class="d-flex justify-content-end">
                <form action="{{ route('basket-place') }}">
                    <button class="btn btn-dark">Оформить заказ</button>
                </form>
            </div>
        </div>
    </div>

@endsection




