<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>5G-store: @yield('admin.title')</title>

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
                <li><a target="_blank" href="{{ route('index') }}" class="nav-link px-2 text-secondary" style="vertical-align: inherit;" style="vertical-align: inherit;">Вурнуться на сайт</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="nav-link px-2 text-secondary" style="vertical-align: inherit;" style="vertical-align: inherit;">Категории</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="nav-link px-2 text-secondary" style="vertical-align: inherit;" style="vertical-align: inherit;">Товары</a></li>
                <li><a href="#" class="nav-link px-2 text-secondary" style="vertical-align: inherit;" style="vertical-align: inherit;">Дом</a></li>
                <li><a href="#" class="nav-link px-2 text-secondary" style="vertical-align: inherit;" style="vertical-align: inherit;">Дом</a></li>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-bg-white" placeholder="Поиск..." aria-label="Поиск">
            </form>

            <div class="text-end">

                    @auth('admin')
                        <a href="{{ route('admin.logout') }}" type="button" class="btn btn-outline-light me-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выйти</font></font></a>
                    @endauth
            </div>
        </div>
    </div>
</header>
<main>


    @yield('admin.content')


</main>
<script src="/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
