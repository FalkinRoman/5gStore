@extends('layouts.master')
@section('title', 'Главная страница')

@section('content')

    <h1 class="text-white m-3">Главная страница</h1>
    <form action="{{ route('index') }}" method="GET" class="form-inline d-flex flex-wrap m-3">
        <div class="form-group">
            <label for="price_from">Цена от:</label>
            <input type="number" class="form-control-sm mx-2" id="price_from" name="price_from" value="{{ request()->price_from }}">
        </div>

        <div class="form-group">
            <label for="price_to">Цена до:</label>
            <input type="number" class="form-control-sm mx-2" id="price_to" name="price_to" value="{{ request()->price_to }}">
        </div>

        <div class="form-group">
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="hit" name="hit" @if(request()->has('hit')) checked @endif>
                <label class="form-check-label" for="hit">Хит</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="new" name="new" @if(request()->has('new')) checked @endif>
                <label class="form-check-label" for="new">Новинка</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" id="recommend" name="recommend" @if(request()->has('recommend')) checked @endif>
                <label class="form-check-label" for="recommend">Рекомендуем</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mx-2">Фильтр</button>
        <a href="{{ route('index') }}" type="reset" class="btn btn-secondary mx-2">Сбросить</a>
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
