@extends('admin.layouts.master')
@section('admin.title', 'Заказ '. $order->name)

@section('admin.content')
    <main>
    <div class="container">

        <h1 class=" mt-4 mb-2">Заказ {{ $order->id }}</h1>
        <p class="mt-2 mb-2">Заказчик: <b>{{ $order->name }}</b></p>
        <p class=" mt-2 mb-4">Номер телефона: <b>{{ $order->phone }}</b></p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Кол-во</th>
                <th scope="col">Цена</th>
                <th scope="col">Стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>
                        <a target="_blank" href="{{ route('product', $product) }}">
                            <img src="{{ Storage::url($product->image) }}">
                            {{ $product-> name }}
                        </a>
                    </td>
                    <td> {{ $product->pivot->count }} шт.</td>
                    <td>{{ $product->price }} руб.</td>
                    <td>{{ $product->getPriceForCount() }} руб.</td>
                </tr>
            @endforeach
                <tr>
                    <td>Общая стоимость</td>
                    <td></td>
                    <td></td>
                    <td><b>{{ $order->getFullPrice() }} руб.</b></td>
                </tr>
            </tbody>

        </table>
    </div>
@endsection




