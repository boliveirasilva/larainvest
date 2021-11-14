@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::open(['route' => ['institution.product.store', $institution->id], 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome do Produto', 'input' => 'name', 'attributes' => ['placeholder' => 'Produto']])
    @include('templates.formulario.text', ['label' => 'Descrição do Produto', 'input' => 'description', 'attributes' => ['rows' => 3, 'cols' => 30, 'placeholder' => 'Sobre o produto...']])
    @include('templates.formulario.input', ['label' => 'Taxa de Juros (%)', 'input' => 'interest_rate', 'attributes' => ['placeholder' => '100']])
    @include('templates.formulario.input', ['label' => 'Indexador', 'input' => 'index', 'attributes' => ['placeholder' => 'CDI']])
    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    <table class="default-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Taxa de Juros</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($institution->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->interest_rate }}% {{ $product->index }}</td>
                <td>
                    {!! Form::open(['route' => ['institution.product.destroy', $institution->id, $product->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Remover') !!}
                    {!! Form::close() !!}
                    <a href="{{ route('institution.product.edit', [$institution->id, $product->id]) }}">Editar</a>
{{--                    <a href="{{ route('institution.show', $inst->id) }}">Detalhes</a>--}}
                </td>
            </tr>
            @empty
            <tr class="empty-table"><td colspan="5">Nenhum produto cadastrado</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
