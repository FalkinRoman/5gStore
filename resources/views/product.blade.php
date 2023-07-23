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

                    @if($product->isAvailable())
                        <form action="{{ route('basket-add', $product) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-primary">В корзину</button>
                        </form>
                    @else
                        <div class="my-3">
                            <span class="text-danger">Нет в наличии</span>
                        </div>

                        <div class="mt-5">
                            <span class="text-muted">Сообщить мне, когда товар появится в наличии:</span>
                            <form action="{{ route('subscription', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group mt-2">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required style="max-width: 300px;"> <!-- Set a maximum width for the email input -->
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Уведомить меня</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
