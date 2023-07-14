@extends('layouts.master')
@section('title', 'Оформление заказа')

@section('content')

    <div class="d-flex justify-content-sm-center mt-5">
        <div class="col-md-7 col-lg-8">
            <h1 class="d-flex justify-content-center align-items-center mb-3">
                <span  class="text-dark">Потвердите заказ </span>
            </h1>
            <h4 class="d-flex justify-content-center align-items-center mb-3">
                <span class="text-dark pr-3">Общая стоимость:</span>
                <span style="margin-left: 10px" class="badge bg-primary rounded-pill">{{ $order->getFullPrice() }} руб.</span>
            </h4>
            <h6 class="d-flex justify-content-center align-items-center mb-3">
                <span  class="text-secondary">Укажите свое имя и телефон, чтобы наш менеджер смог с вами связаться.  </span>
            </h6>
            <form action="{{ route('basket-confirm') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="row g-3">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя">
                    </div>

                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Номер телефона</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Введите номер телефона">
                    </div>


                    <button class="w-100 btn btn-primary btn-lg" type="submit">Потвердить заказ</button>
                </div>
            </form>
        </div>
    </div>

@endsection




