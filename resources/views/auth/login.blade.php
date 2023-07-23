@extends('layouts.master')

@section('title', 'Авторизоваться')

@section('content')
    <div class="container col-sm-6 mt-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Авторизоваться</h2>
                <form action="{{ route('login_process') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Пароль:</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Войти</button>
                </form>
                <div class="mt-3">
                    <a href="{{ route('forgot') }}">Забыли пароль?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
