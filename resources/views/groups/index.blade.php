@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::open(['route' => 'group.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome do Grupo', 'input' => 'name', 'attributes' => ['placeholder' => 'Grupo']])
        @include('templates.formulario.select', ['label' => 'Usuário', 'select' => 'user_id', 'data' => $users_list, 'attributes' => ['placeholder' => 'Usuário']])
        @include('templates.formulario.select', ['label' => 'Nome da Instituição', 'select' => 'institution_id', 'data' => $institutions_list, 'attributes' => ['placeholder' => 'Instituição']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('groups.list', ['group_list' => $groups])
@endsection
