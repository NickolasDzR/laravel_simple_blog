<html lang="">
<head>
    <title>Simple blog - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ujs/1.2.3/rails.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="{{ route("posts.index") }}">Все посты</a>
            <a class="navbar-brand me-auto" href="{{ route("posts.create") }}">Создать пост</a>
        </div>
    </nav>
</div>
            <br>
            <br>
            <br>
            <br>
<main class="container">
    @include('shared.flash')

    @yield('content')
</main>
</body>
</html>
