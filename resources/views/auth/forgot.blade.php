@extends('layouts.master')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="container col-sm-6 mt-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Восстановление пароля</h2>
                <form action="{{ route('forgot_process') }}" method="POST">
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

                    <button type="submit" class="btn btn-primary mt-3">Восстановить</button>
                </form>
                <div class="mt-3">
                    <a href="{{ route('login') }}">Вспомнил пароль</a>
                </div>
            </div>
        </div>
    </div>
@endsection
