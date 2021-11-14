@extends('templates.master')

@php
    $group_list = (empty($group_list) ? [] : $group_list);
    $product_list = (empty($product_list) ? [] : $product_list);
@endphp

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message')['messages'] }}</h3>
        <hr>
    @endif

    {!! Form::open(['route' => 'movement.withdraw.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.select', ['label' => 'Grupo', 'select' => 'group_id', 'data' => $group_list, 'attributes' => ['placeholder' => 'Grupo']])
    @include('templates.formulario.select', ['label' => 'Produto', 'select' => 'product_id', 'data' => $product_list, 'attributes' => ['placeholder' => 'Produto']])
    @include('templates.formulario.input', ['label' => 'Valor', 'input' => 'value', 'attributes' => ['placeholder' => 'Valor']])
    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}
@endsection