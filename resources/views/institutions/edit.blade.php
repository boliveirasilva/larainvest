@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::model($institution, ['route' => ['institution.update', $institution->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome da Instituição', 'input' => 'name', 'attributes' => ['placeholder' => 'Instituição']])
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}
@endsection
