@extends('layouts.master')
@section('title', 'Категории товаров')

@section('content')
    @foreach($categories as $category)
        <div class="card text-center">
            <div class="card-header">

            </div>
            <div class="card-body">
                <img class="" style="height: 70px"
                     src="{{ Storage::url($category->image) }} ">
                <h5 class="card-title">{{$category->name}}</h5>
                <p class="card-text">{{$category->description}}</p>
                <a href="/{{$category->code}}" class="btn btn-primary">Подробнее</a>
            </div>
        </div>
    @endforeach
@endsection




