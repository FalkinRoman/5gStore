@extends('admin.layouts.master')
@isset($review)
    @section('admin.title', 'Редактировать отзыв ' .$review->user->email)
@else
    @section('admin.title', 'Создать отзыв')
@endisset


@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @isset($review)
                        <h2>Редактировать отзыв <b>{{ $review->user->email }}</b></h2>
                    @else
                        <h2>Создать отзыв</h2>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Отзывы</a></li>
                        <li class="breadcrumb-item active">
                            @isset($review)
                                Редактировать отзыв
                            @else
                                Создать отзыв
                            @endisset
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-body pt-0">
        <div class="card card-primary">
            <div class="card-header">
                @isset($review)
                    <h3 class="card-title">Изменить данные</h3>
                @else
                    <h3 class="card-title">Ваш новый отзыв</h3>
                @endisset
            </div>


            <form  method="POST" enctype="multipart/form-data"
                   @isset($review)
                       action="{{ route('admin.reviews.update',$review->id) }}"
                   @else
                       action="{{ route('admin.reviews.store') }}"
                @endisset
            >
                <div class="card-body">
                @csrf
{{--                Изменяем метод на PUT для update--}}
                @isset($review)
                    @method('PUT')
                @endisset

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="user_id">Пользователь:</label>
                        <select name="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user_id', isset($review) ? $review->user_id : null) == $user->id) selected @endif>{{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_id">Продукт:</label>
                        <select name="product_id" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @if(old('product_id', isset($review) ? $review->product_id : null) == $product->id) selected @endif>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rating">Рейтинг:</label>
                        <input placeholder="Введите рейтинг" name="rating" type="number" min="1" max="5" class="form-control @error('rating') is-invalid @enderror" id="rating" value="{{ old('rating', isset($review) ? $review->rating : null) }}">
                        @error('rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="comment">Отзыв:</label>
                        <textarea placeholder="Введите отзыв" name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment">{{ old('comment', isset($review) ? $review->comment : null) }}</textarea>
                        @error('comment')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

