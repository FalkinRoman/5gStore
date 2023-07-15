@extends('admin.layouts.master')
@isset($category)
    @section('admin.title', 'Редактировать категорию ' .$category-> name)
@else
    @section('admin.title', 'Создать категорию')
@endisset


@section('admin.content')
    <body>
    <div class="container mt-4">
        @isset($category)
            <h2>Редактировать категорию <b>{{ $category->name }}</b></h2>
        @else
            <h2>Создать категорию</h2>
        @endisset
        <form  method="POST" enctype="multipart/form-data"
        @isset($category)
            action="{{ route('admin.categories.update',$category->id) }}"
            @else
            action="{{ route('admin.categories.store') }}"
            @endisset
        >
            @csrf
{{--            Изменяем метод на PUT для update--}}
            @isset($category)
                @method('PUT')
            @endisset

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group mt-4">
                <label for="code">Код:</label>
                <input name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Введите код" value=" {{ old('code', isset($category) ? $category->code: null) }}">
                @error('code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="name">Название:</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название" value="{{ old('name', isset($category) ? $category->name: null) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="description">Описание:</label>
                <textarea name="description" class="@error('description') is-invalid @enderror form-control" id="description" rows="5" placeholder="Введите описание">{{ old('description', isset($category) ? $category->description: null) }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="image">Картинка:</label>
                <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($category) ? $category->image: null) }}">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </div>
    </body>

@endsection




