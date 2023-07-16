@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Заказы')

@section('admin.content')
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
                    <td>{{ $order->getFullPrice() }} руб.</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">Открыть</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection




