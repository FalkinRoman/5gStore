@extends('layouts.master')
@section('title', 'Личный кабинет')

@section('content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Заказы</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Когда отправлен</th>
                <th scope="col">Сумма</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>{{ $order->calculateFullSum() }} ₽</td>
                    <td>
                        <a href="{{ route("orders.show", $order) }}" class="btn btn-primary">Открыть</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div id="pagination" class="d-flex justify-content-start mt-3">
            {{ $orders->links() }}
        </div>

        <h1 class="text-center mt-4 mb-4">Кошелек</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Лого</th>
                <th scope="col">Название</th>
                <th scope="col">Баланс кошелька</th>
                <th scope="col">Сумма</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($wallets as $wallet)
                <tr>
                    <th scope="row">{{ $wallet->cryptocurrency->id }}</th>
                    <td><img style="height:24px; width: 24px;" src="{{ Storage::url($wallet->cryptocurrency->image) }} "></td>
                    <td>{{ $wallet->cryptocurrency->name }}</td>
                    <td>{{ number_format($wallet->balance , 4)}} {{ $wallet->cryptocurrency->small_name }}</td>
                    <td>{{  number_format($wallet->balance * $wallet->cryptocurrency->getCurrentPriceBySymbol($wallet->cryptocurrency->symbol), 2)}} $</td>
                    <td>
                        <a href="" class="btn btn-primary">Вывод средств</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div id="pagination" class="d-flex justify-content-start mt-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection




