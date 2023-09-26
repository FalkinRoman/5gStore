@extends('admin.layouts.master')
@section('admin.title', $brand->name)

@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Бренд <b>{{ $brand->name }}</b></h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Бренды</a></li>
                        <li class="breadcrumb-item active">
                               <b>{{ $brand->name }}</b>
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
                    <td>{{ $brand->id }}</td>
                </tr>
                <tr>
                    <td>Код</td>
                    <td>{{ $brand->code }}</td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td>{{ $brand->name }}</td>
                </tr>
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($brand->image) }} "></td>
                </tr>
                </tbody>

            </table>

        </div>

    </div>

@endsection

