@extends('templates.master')

@section('content-view')
    <header>
        <h1>{{ $group->name }}</h1>
        <h2>Instituição: {{ $group->institution->name }}</h2>
        <h2>Responsável: {{ $group->owner->name }}</h2>
    </header>

    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::open(['route' => ['group.user.store', $group->id], 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.select', ['label' => 'Usuário', 'select' => 'user_id', 'data' => $users_list, 'attributes' => ['placeholder' => 'Usuário']])
        @include('templates.formulario.submit', ['input' => 'Relacionar ao Grupo: ' . $group->name])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $group->users])
@endsection