@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Криптовалюты')

@section('admin.content')
    <main>
    <div class="container">

        <h1 class="text-center mt-4 mb-4">Криптовалюты</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Лого</th>
                <th scope="col">Название</th>
                <th scope="col">Символ</th>
                <th scope="col">Цена</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cryptocurrencies as $cryptocurrency)
                <tr>
                    <th scope="row">{{ $cryptocurrency->id }}</th>
                    <td><img style="height:24px; width: 24px;" src="{{ Storage::url($cryptocurrency->image) }} "></td>
                    <td>{{ $cryptocurrency->name }}</td>
                    <td>{{ $cryptocurrency->symbol }}</td>
                    <td>{{ $cryptocurrency->getCurrentPriceBySymbol($cryptocurrency->symbol) }} $</td>
                    <td>
                        <form action="{{ route('admin.cryptocurrencies.destroy', $cryptocurrency->id ) }}" method="POST" >
                        <a href="{{ route('admin.cryptocurrencies.edit', $cryptocurrency->id) }}" class="btn btn-warning">Редактировать</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Вы точно хотите удалить криптовалюту?')" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
        <a href="{{ route('admin.cryptocurrencies.create') }}" class="btn btn-primary">Добавить криптовалюту</a>
    </div>
@endsection




