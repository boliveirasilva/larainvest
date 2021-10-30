<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('css-view')
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One" rel="stylesheet">
</head>
<body>
@include('templates.sidebar')

<section id="container">
    @yield('content-view')
</section>

@yield('js-view')
</body>
</html>