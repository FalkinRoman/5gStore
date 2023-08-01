@extends('layouts.master')
@section('title', 'Оформление заказа')

@section('content')

    <div class="d-flex justify-content-sm-center mt-5">
        <div class="col-md-7 col-lg-8">
            <h1 class="d-flex justify-content-center align-items-center mb-3">
                <span class="text-dark">Подтвердите заказ</span>
            </h1>
            <h4 class="d-flex justify-content-center align-items-center mb-3">
                <span class="text-dark pr-3">Общая стоимость:</span>
                <span style="margin-left: 10px" class="badge bg-primary rounded-pill">{{ $order->calculateFullSum() }} руб.</span>
            </h4>
            <div class="d-flex flex-column align-items-center">
                <h5>Вы получаете кэшбэк в криптовалюте</h5>
                <div class="d-flex ">
                    @foreach ($order->calculateTotalSumForCrypto() as $cryptoImage => $totalSum)
                        <div class="d-flex">
                            <img class="m-1" style="height: 30px; width: 30px;" src="{{ Storage::url($cryptoImage) }}" >
                            <p class="m-1" >{{ $totalSum }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <h6 class="d-flex justify-content-center align-items-center mb-3 mt-3">
                <span class="text-secondary">Укажите свое имя и телефон, чтобы наш менеджер смог с вами связаться.</span>
            </h6>
            <form action="{{ route('basket-confirm') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="row g-3">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Имя</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Введите имя" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Номер телефона</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Введите номер телефона" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @guest('web')
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Введите email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    @endguest

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Подтвердить заказ</button>
                </div>
            </form>
        </div>
    </div>

@endsection
