@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
    @endif

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('user.form-fields')
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $users])
@endsection