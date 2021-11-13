@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome do Grupo', 'input' => 'name', 'attributes' => ['placeholder' => 'Grupo']])
        @include('templates.formulario.select', ['label' => 'Dono do Grupo', 'select' => 'user_id', 'data' => $users_list, 'attributes' => ['placeholder' => 'Responsável']])
        @include('templates.formulario.select', ['label' => 'Nome da Instituição', 'select' => 'institution_id', 'data' => $institutions_list, 'attributes' => ['placeholder' => 'Instituição']])
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}

{{--    @include('groups.list', ['group_list' => $groups])--}}
@endsection
