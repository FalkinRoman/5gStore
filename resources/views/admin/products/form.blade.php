@extends('admin.layouts.master')

@isset($product)
    @section('admin.title', 'Редактировать товар ' . $product->name)
@else
    @section('admin.title', 'Создать товар')
@endisset

@section('admin.content')
    <div class="container mt-4">
        @isset($product)
            <h2>Редактировать товар <b>{{ $product->name }}</b></h2>
        @else
            <h2>Создать товар</h2>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
                  action="{{ route('admin.products.update', $product->id) }}"
              @else
                  action="{{ route('admin.products.store') }}"
            @endisset
        >
            @csrf
            {{-- Изменяем метод на PUT для update --}}
            @isset($product)
                @method('PUT')
            @endisset

            <div class="form-group mt-4">
                <label for="code">Код:</label>
                <input name="code" type="text" class="form-control @error('code') is-invalid @enderror"
                       id="code" placeholder="Введите код"
                       value="{{ old('code', isset($product) ? $product->code : null) }}">
                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="name">Название:</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" placeholder="Введите название"
                       value="{{ old('name', isset($product) ? $product->name : null) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="description">Описание:</label>
                <textarea name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          id="description" rows="5" placeholder="Введите описание">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="category_id">Выберите категорию:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @isset($product)
                                    @if($product->category_id == $category->id)
                                        selected
                            @endif
                            @endisset
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-4">
                <label for="image">Картинка:</label>
                <input name="image" type="file" class="form-control-file" id="image"
                       value="{{ old('image', isset($product) ? $product->image : null) }}">
            </div>

            <div class="form-group mt-4">
                <label for="price">Цена:</label>
                <input name="price" type="text" class="form-control @error('price') is-invalid @enderror"
                       id="price" placeholder="Введите цену"
                       value="{{ old('price', isset($product) ? $product->price : null) }}">
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label for="count">Колличество товаров:</label>
                <input name="count" type="text" class="form-control @error('count') is-invalid @enderror"
                       id="count" placeholder="Введите кол-во"
                       value="{{ old('count', isset($product) ? $product->count : null) }}">
                @error('count')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <h4>Дополнительные характеристики:</h4>
                @foreach([
                                  'hit' => 'Хит',
                                  'new' => 'Новинка',
                                  'recommend' => 'Рекомендуемые',
                                ] as $field => $title)
                    <div class="form-check">
                        <input name="{{ $field }}" type="checkbox" class="form-check-input" id="{{ $field }}"
                                @if(isset($product) && $product->$field === 1)
                                    checked = 'checked'
                                @endif
                        <label class="form-check-label" for="{{ $field }}">{{ $title }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </div>
@endsection
