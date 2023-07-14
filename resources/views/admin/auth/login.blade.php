@extends('layouts.master')

@section('title', 'Авторизоваться')

@section('content')
    <div class="container  col-sm-6  mt-4 ">
        <h2>Авторизоваться администратору</h2>
        <form action="{{ route('admin.login_process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary mt-3">Войти</button>
        </form>
    </div>

@endsection
