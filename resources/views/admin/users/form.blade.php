@extends('admin.layouts.master')
@isset($user)
    @section('admin.title', 'Редактировать профиль ' .$user-> name)
@else
    @section('admin.title', 'Создать пользователя')
@endisset


@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @isset($user)
                        <h2>Редактировать пользователя <b>{{ $user->name }}</b></h2>
                    @else
                        <h2>Создать пользователя</h2>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                        <li class="breadcrumb-item active">
                            @isset($user)
                                Редактировать пользовтеля <b>{{ $user->name }}</b>
                            @else
                                Создать пользователя
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
                @isset($user)
                    <h3 class="card-title">Изменить данные</h3>
                @else
                    <h3 class="card-title">Ваш новый пользователь</h3>
                @endisset
            </div>


            <form  method="POST" enctype="multipart/form-data"
                   @isset($user)
                       action="{{ route('admin.users.update',$user->id) }}"
                   @else
                       action="{{ route('admin.users.store') }}"
                @endisset
            >
                <div class="card-body">
                @csrf
{{--                Изменяем метод на PUT для update--}}
                @isset($user)
                    @method('PUT')
                @endisset

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group mt-2">
                    <label for="name">Имя:</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название" value="{{ old('name', isset($user) ? $user->name: null) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                    <div class="form-group ">
                        <label for="email">email:</label>
                        <input placeholder="Введите email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"  value=" {{ old('email', isset($user) ? $user->email: null) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Новый пароль:</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Введите новый пароль" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                        <div class="form-group">
                            <label for="old_password">Старый пароль:</label>
                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Введите старый пароль" value="{{ old('old_password') }}">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                    {{--                <div class="form-group mt-2">--}}
{{--                    <label for="image">Картинка:</label>--}}
{{--                    <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($user) ? $user->image: null) }}">--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@endsection

