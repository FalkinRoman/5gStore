@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Категории')

@section('admin.content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Категории</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Код</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->id ) }}" method="POST" >
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-success">Открыть</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
    </div>
@endsection




