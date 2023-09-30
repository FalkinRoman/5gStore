@extends('admin.layouts.master')
@isset($subcategory)
    @section('admin.title', 'Редактировать подкатегорию ' .$subcategory-> name)
@else
    @section('admin.title', 'Создать подкатегорию')
@endisset


@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @isset($subcategory)
                        <h2>Редактировать подкатегорию <b>{{ $subcategory->name }}</b></h2>
                    @else
                        <h2>Создать подкатегорию</h2>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.subcategories.index') }}">Подкатегории</a></li>
                        <li class="breadcrumb-item active">
                            @isset($subcategory)
                                Редактировать подкатегорию <b>{{ $subcategory->name }}</b>
                            @else
                                Создать подкатегорию
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
                @isset($subcategory)
                    <h3 class="card-title">Изменить данные</h3>
                @else
                    <h3 class="card-title">Ваша новая подкатегория</h3>
                @endisset
            </div>


            <form  method="POST" enctype="multipart/form-data"
                   @isset($subcategory)
                       action="{{ route('admin.subcategories.update',$subcategory->id) }}"
                   @else
                       action="{{ route('admin.subcategories.store') }}"
                @endisset
            >
                <div class="card-body">
                @csrf
{{--                Изменяем метод на PUT для update--}}
                @isset($subcategory)
                    @method('PUT')
                @endisset

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group ">
                    <label for="code">Код:</label>
                    <input placeholder="Введите код" name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code"  value=" {{ old('code', isset($subcategory) ? $subcategory->code: null) }}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="name">Название:</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название" value="{{ old('name', isset($subcategory) ? $subcategory->name: null) }}">
                    @error('name')
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
                                        @isset($subcategory)
                                            @if($subcategory->category_id == $category->id)
                                                selected
                                    @endif
                                    @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                <div class="form-group mt-2">
                    <label for="image">Картинка:</label>
                    <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($subcategory) ? $subcategory->image: null) }}">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

