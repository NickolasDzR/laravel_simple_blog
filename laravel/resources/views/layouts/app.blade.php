<html lang="">
<head>
    <title>Simple blog - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="{{ route("posts.index") }}">Все посты</a>
            @auth
                @can('create-post')
                    <a class="navbar-brand me-auto" href="{{ route("posts.create") }}">Создать пост</a>
                @endcan
                <a class="navbar-brand me-auto" href="{{ route("posts.home") }}">Привет, {{ auth()->user()->name }}!</a>
                <a class="btn btn-danger" href="{{ route("logout") }}">Выйти</a>
            @else
                <a class="navbar-brand me-auto" href="{{ route("register.create") }}">Регистрация</a>
                <a class="navbar-brand me-auto" href="{{ route("login") }}">Войти</a>
            @endauth
        </div>
    </nav>
</div>
            <br>
            <br>
            <br>
            <br>
<main class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @include('shared.flash')

    @yield('content')
</main>
</body>
</html>
