@extends('layouts.master')

@section('title', $product )

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <img class="max-width: 100%; max-h-3" src="...">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$product}}</h5>
            <h5></h5>
            <p class="card-text">В этом разделе вы найдете самые популярные телефоны по отличным ценам.</p>
            <a href="#" class="btn btn-primary">Подробнее</a>
        </div>
    </div>
@endsection

