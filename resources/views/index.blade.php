@extends('layouts.master')
@section('title', 'Главная страница')

@section('content')
    <h1 class="text-white">Главная страница</h1>
    <div class="" style="display: flex; flex-wrap: wrap; width: 100%">
        @foreach($products as $product)
            @include('layouts.card', $product)
        @endforeach
    </div>
@endsection




