@extends('admin.layouts.master')
@section('admin.title', $product->name)

@section('admin.content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Товар {{ $product->name }}</h1>
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
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $product->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Категория</td>
                    <td>{{ $product->category->name }}</td>
                </tr>

                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($product->image) }} "></td>
                </tr>
                <tr>
                    <td>Цена</td>
                    <td>{{ $product->price }} руб.</td>
                </tr>
            </tbody>

        </table>
    </div>
@endsection




