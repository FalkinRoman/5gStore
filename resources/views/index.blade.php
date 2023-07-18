@extends('layouts.master')
@section('title', 'Главная страница')

@section('content')

    <h1 class="text-white m-3">Главная страница</h1>
    <form action="{{ route('index') }}" method="GET" class="form-inline d-flex flex-wrap m-3">
        <div class="form-group">
            <label for="price-from">Цена от:</label>
            <input type="number" class="form-control-sm mx-2" id="price-from" name="price-from">
        </div>

        <div class="form-group">
            <label for="price-to">Цена до:</label>
            <input type="number" class="form-control-sm mx-2" id="price-to" name="price-to">
        </div>

        <div class="form-group">
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="checkbox-hot" name="checkbox-hot">
                <label class="form-check-label" for="checkbox-hot">Хит</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="checkbox-new" name="checkbox-new">
                <label class="form-check-label" for="checkbox-new">Новинка</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="checkbox-recommended" name="checkbox-recommended">
                <label class="form-check-label" for="checkbox-recommended">Рекомендуем</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mx-2">Фильтр</button>
        <button type="reset" class="btn btn-secondary mx-2">Сбросить</button>
    </form>
    <div class="d-flex flex-wrap justify-content-start">
        @foreach($products as $product)
            @include('layouts.card', $product)
        @endforeach
    </div>
    {{-- Пагинация для продуктов --}}
    <div id="pagination" class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
@endsection
