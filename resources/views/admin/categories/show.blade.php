@extends('admin.layouts.master')
@section('admin.title', $category->name)

@section('admin.content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Категория {{ $category->name }}</h1>
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
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $category->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($category->image) }} "></td>
                </tr>
                <tr>
                    <td>Колличество товаров</td>
                    <td>{{ $category->products->count() }}</td>
                </tr>
            </tbody>

        </table>
    </div>
@endsection




