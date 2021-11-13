@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::model($product, ['route' => ['institution.product.update', $product->institution_id, $product->id], 'method' => 'put', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome do Produto', 'input' => 'name', 'attributes' => ['placeholder' => 'Produto']])
    @include('templates.formulario.text', ['label' => 'Descrição do Produto', 'input' => 'description', 'attributes' => ['rows' => 3, 'cols' => 30, 'placeholder' => 'Sobre o produto...']])
    @include('templates.formulario.input', ['label' => 'Taxa de Juros (%)', 'input' => 'interest_rate', 'attributes' => ['placeholder' => '100']])
    @include('templates.formulario.input', ['label' => 'Indexador', 'input' => 'index', 'attributes' => ['placeholder' => 'CDI']])
    @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}

@endsection
