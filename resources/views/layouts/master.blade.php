<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>5G-store: @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Начальная загрузка"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('index') }}" class="nav-link px-2  text-secondary btn  @if(Route::currentRouteNamed('index')) text-white  @endif " style="vertical-align: inherit;">Главная страница</a></li>
                <li><a href="{{ route('categories') }}" class="nav-link px-2 text-secondary @if(Route::currentRouteNamed('categor*')) text-white  @endif" style="vertical-align: inherit;" style="vertical-align: inherit;">Категории</a></li>
                <li><a href="{{ route('basket') }}" class="nav-link px-2 text-secondary @if(Route::currentRouteNamed('basket*')) text-white  @endif" style="vertical-align: inherit;" style="vertical-align: inherit;">Корзина</a></li>


            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="{{ route('index') }}" method="GET">
                <input type="search" name="search" class="form-control form-control-dark text-bg-white" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">

            </form>



            <div class="text-end">
                @guest('web')
                <a href="{{ route('login') }}" type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Войти</font></font></a>
                <a href="{{ route('register') }}" type="button" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Зарегистрироваться</font></font></a>
                @endguest

                @auth('web')
                        <a href="{{ route('home') }}" type="button" class="btn btn-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Личный кабинет</font></font></a>
                        <a href="{{ route('logout') }}" type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выйти</font></font></a>
                    @endauth

            </div>
        </div>
    </div>
</header>
<main >
    {{--    уведомление об удачном выполнении или добавлении--}}
    @if(session()->has('success'))
        <div class="alert alert-success d-flex  align-items-center justify-content-center" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    {{--    уведомление об ошибке или удалении--}}
    @if(session()->has('warning'))
        <div class="alert alert-danger d-flex  align-items-center justify-content-center" role="alert">
            {{ session() -> get('warning') }}
        </div>
    @endif

    @yield('content')




</main>
<script src="/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
