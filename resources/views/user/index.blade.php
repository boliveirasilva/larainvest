@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
    @endif

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['input' => 'cpf', 'attributes' => ['placeholder' => 'CPF']])
        @include('templates.formulario.input', ['input' => 'name', 'attributes' => ['placeholder' => 'Nome Completo']])
        @include('templates.formulario.input', ['input' => 'phone', 'attributes' => ['placeholder' => 'Telefone']])
        @include('templates.formulario.input', ['input' => 'email', 'attributes' => ['placeholder' => 'E-mail']])
        @include('templates.formulario.password', ['input' => 'password', 'attributes' => ['placeholder' => 'Senha']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $users])
@endsection