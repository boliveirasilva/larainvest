@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
    @endif

    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('user.form-fields')
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}

{{--    @include('user.list', ['user_list' => $users])--}}
@endsection