@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Товары')

@section('admin.content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Товары</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Код</th>
                <th scope="col">Название</th>
                <th scope="col">Категория</th>
                <th scope="col">Цена</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
{{--                   // @dd($product)--}}
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name}}</td>
                    <td>{{ $product->price}} руб.</td>
                    <td>
                        <form action="{{ route('admin.products.destroy', $product->id ) }}" method="POST" >
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-success">Открыть</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Добавить товар</a>
    </div>
@endsection




