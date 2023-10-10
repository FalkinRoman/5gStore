@extends('admin.layouts.master')
@section('admin.title', $review->user->email)

@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Отзыв <b>{{ $review->user->email }}</b></h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Отзывы</a></li>
                        <li class="breadcrumb-item active">
                               <b>{{ $review->user->email }}</b>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card">

        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Поле</th>
                    <th scope="col">Значение</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $review->id }}</td>
                </tr>
                <tr>
                    <td>Имя пользователя</td>
                    <td>{{ $review->user->name }}</td>
                </tr>
                <tr>
                    <td>Email пользователя</td>
                    <td>{{ $review->user->email }}</td>
                </tr>
                <tr>
                    <td>Название продукта</td>
                    <td>{{ $review->product->name }}</td>
                </tr>
                <tr>
                    <td>Рейтинг</td>
                    <td>{{ $review->rating }}</td>
                </tr>
                <tr>
                    <td>Комментарий</td>
                    <td>{{ $review->comment }}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y, H:i:s') }}</td>
                </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection

