<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Авторизация для администратора">
    <title>Авторизация для администратора</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Стили для центрирования формы */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<main class="form-container">
    <form action="{{ route('admin.login_process') }}" method="POST" class="form-signin">
        @csrf
        <img class="mb-4" src="/img/logomin.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Авторизоваться администратору</h1>

        {{-- Вывод ошибок в верхней части страницы --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="form-floating">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="falkin95@mail.ru" required>
            <!-- value="{{ old('email') }}" - добавить выше для input  -->
            <label for="email">Email:</label>
        </div>
        <div class="form-floating mt-3">
            <input type="password" value="123456" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            <label for="password">Пароль:</label>
        </div>

        <div class="checkbox mb-3 mt-3">
            <label>
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
        <p class="mt-5 mb-3 text-muted">© 2022–2023</p>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
