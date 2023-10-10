@extends('admin.layouts.master')
@section('admin.title', $user->name)

@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Пользователь <b>{{ $user->name }}</b></h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                        <li class="breadcrumb-item active">
                               <b>{{ $user->name }}</b>
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
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Дата регистрации</td>
                    <td>{{ $user->created_at }}</td>
                </tr>

{{--                <tr>--}}
{{--                    <td>Картинка</td>--}}
{{--                    <td><img style="height: 50px" src="{{ Storage::url($user->image) }} "></td>--}}
{{--                </tr>--}}
                </tbody>

            </table>

        </div>

    </div>

@endsection

