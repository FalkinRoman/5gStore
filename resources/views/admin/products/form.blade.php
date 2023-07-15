@extends('admin.layouts.master')
@isset($product)
    @section('admin.title', 'Редактировать товар ' .$product-> name)
@else
    @section('admin.title', 'Создать товар')
@endisset


@section('admin.content')
    <body>
    <div class="container mt-4">
        @isset($product)
            <h2>Редактировать товар <b>{{ $product->name }}</b></h2>
        @else
            <h2>Создать товар</h2>
        @endisset
        <form  method="POST" enctype="multipart/form-data"
        @isset($product)
            action="{{ route('admin.products.update',$product->id) }}"
            @else
            action="{{ route('admin.products.store') }}"
            @endisset
        >
            @csrf
{{--            Изменяем метод на PUT для update--}}
            @isset($product)
                @method('PUT')
            @endisset

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group mt-4">
                <label for="code">Код:</label>
                <input name="code" type="text" class="@error('code') is-invalid @enderror form-control" id="code" placeholder="Введите код" value="{{ old('code', isset($product) ? $product->code: null) }}">
                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="name">Название:</label>
                <input name="name" type="text" class="@error('name') is-invalid @enderror form-control" id="name" placeholder="Введите название" value="{{ old('name', isset($product) ? $product->name: null) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="description">Описание:</label>
                <textarea name="description" class="@error('description') is-invalid @enderror form-control" id="description" rows="5" placeholder="Введите описание">{{ old('description', isset($product) ? $product->description: null) }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleSelect">Выберите категорию:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @isset($product)
                                @if($product->category_id == $category->id)
                                    selected
                                @endif
                                @endisset
                        > {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="image">Картинка:</label>
                <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($product) ? $product->image: null) }}">
            </div>
            <div class="form-group mt-2">
                <label for="description">Цена:</label>
                <input name="price" type="text" class="@error('price') is-invalid @enderror form-control" id="price" placeholder="Введите цену" value="{{ old('price', isset($product) ? $product->price: null) }}">
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </div>
    </body>

@endsection




