@extends('admin.layouts.master')
@isset($brand)
    @section('admin.title', 'Редактировать категорию ' .$brand-> name)
@else
    @section('admin.title', 'Создать бренд')
@endisset


@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @isset($brand)
                        <h2>Редактировать бренд <b>{{ $brand->name }}</b></h2>
                    @else
                        <h2>Создать бренд</h2>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Бренды</a></li>
                        <li class="breadcrumb-item active">
                            @isset($brand)
                                Редактировать бренд <b>{{ $brand->name }}</b>
                            @else
                                Создать бренд
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
                @isset($brand)
                    <h3 class="card-title">Изменить данные</h3>
                @else
                    <h3 class="card-title">Ваш новый бренд</h3>
                @endisset
            </div>


            <form  method="POST" enctype="multipart/form-data"
                   @isset($brand)
                       action="{{ route('admin.brands.update',$brand->id) }}"
                   @else
                       action="{{ route('admin.brands.store') }}"
                @endisset
            >
                <div class="card-body">
                @csrf
{{--                Изменяем метод на PUT для update--}}
                @isset($brand)
                    @method('PUT')
                @endisset

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group ">
                    <label for="code">Код:</label>
                    <input placeholder="Введите код" name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code"  value=" {{ old('code', isset($brand) ? $brand->code: null) }}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="name">Название:</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название" value="{{ old('name', isset($brand) ? $brand->name: null) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="image">Картинка:</label>
                    <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($brand) ? $brand->image: null) }}">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

