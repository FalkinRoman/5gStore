@extends('admin.layouts.master')
@section('admin.title', $product->name)

@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Продукт <b>{{ $product->name }}</b></h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Продукты</a></li>
                        <li class="breadcrumb-item active">
                            <b>{{ $product->name }}</b>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card">

        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Поле</th>
                    <th scope="col">Значение</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $product->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Описание</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Категория</td>
                    <td>{{ $product->category->name }}</td>
                </tr>

                <tr>
                    <td>Подкатегория</td>
                    <td>{{ $product->subcategory->name ?? "не выбрано"}}</td>
                </tr>

                <tr>
                    <td>Бренд</td>
                    <td>{{ $product->brand->name }}</td>
                </tr>

                <tr>
                    <td>Картинка</td>
                    <td><img style="height:140px; width: 120px;" src="{{ Storage::url($product->image) }} "></td>
                </tr>
                <tr>
                    <td>Цена</td>
                    <td>{{ $product->price }}  ₽</td>
                </tr>
                <tr>
                    <td>Колличество товаров</td>
                    <td>{{ $product->count}} шт</td>
                </tr>
                <tr>
                    <td>Лейблы</td>
                    <td>
                        <div class="d-flex">
                            @if($product->isNew())
                                <span class="badge bg-primary m-1">Новинка</span>
                            @endif
                            @if($product->isHit())
                                <span class="badge bg-danger m-1">Хит продаж</span>
                            @endif
                            @if($product->isRecommend())
                                <span class="badge bg-success m-1">Рекомендуем</span>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Криптовалюта</td>
                    <td>
                        @if($cryptocurrency)
                            <img style="height: 30px; width: 30px;" src="{{ Storage::url($cryptocurrency->image) }}" alt="{{ $cryptocurrency->name }}">
                            {{ $cryptocurrency->name }}
                        @else
                            Не указано
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Процент кэшбэка</td>
                    <td>{{ $cashbackPercentage ?? 'Не указано' }}</td>
                </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection


