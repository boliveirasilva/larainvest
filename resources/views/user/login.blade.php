<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Larainvest</title>
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <div class="background"></div>
    <section id="content-view" class="login">
        <h1>Larainvest</h1>
        <h3>O nosso gerenciador de investimento</h3>

        {!! Form::open(['route' => 'user.auth', 'method' => 'post']) !!}
        <p>Acesse o sistema</p>

        <label>
            {!! Form::text('username', '', ['class' => 'input', 'placeholder' => 'Usuário']) !!}
        </label>
        <label>
            {!! Form::password('password', ['class' => 'input', 'placeholder' => 'Senha']) !!}
        </label>

        {!! Form::submit('Entrar') !!}

        {!! Form::close() !!}
    </section>
</body>
</html>