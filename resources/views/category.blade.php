@extends('layouts.master')

@section('title',  $category->name)

@section('content')
    <h1 class="text-white">{{ $category->name}}</h1>
    <h5 class="text-green-700">{{ $category->description }}</h5>
    <div class="d-flex">
        {{--        products-> получил с модели: Category (функция products)--}}
        @foreach($category->products()->with('category')->get() as $product)
            @include('layouts.card', $product)
        @endforeach


    </div>
@endsection

