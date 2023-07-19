@extends('layouts.master')
@section('title', "Товар" . $product->name )

@section('content')
    <div class="card my-3 mx-2">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img class="card-img img-fluid rounded p-5" src="{{ Storage::url($product->image) }}" alt="{{$product->name}}" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">{{$product->name}}</h3>
                    <h5 class="card-subtitle mb-2 text-muted">{{$product->category->name}}</h5>
                    <p class="card-text">Цена: <b>{{ $product->price }} ₽</b></p>
                    <p class="card-text">{{$product->description}}</p>
                    <form action="{{ route('basket-add', $product) }}" method="POST" class="mt-3">
                        @csrf
                        @if($product->isAvailable())
                            <button type="submit" class="btn btn-primary">В корзину</button>
                        @else
                            <span class="text-danger">Нет в наличии</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
