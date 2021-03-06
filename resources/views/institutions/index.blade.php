@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
        <hr>
    @endif

    {!! Form::open(['route' => 'institution.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome da Instituição', 'input' => 'name', 'attributes' => ['placeholder' => 'Instituição']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    <table class="default-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome da Instituição</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        @forelse($institutions as $inst)
        <tr>
            <td>{{ $inst->id }}</td>
            <td>{{ $inst->name }}</td>
            <td>
                {!! Form::open(['route' => ['institution.destroy', $inst->id], 'method' => 'delete']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ route('institution.edit', $inst->id) }}">Editar</a>
                <a href="{{ route('institution.show', $inst->id) }}">Detalhes</a>
                <a href="{{ route('institution.product.index', $inst->id) }}">Produtos</a>
            </td>
        </tr>
        @empty
        <tr class="empty-table"><td colspan="3">Nenhum registro encontrado!</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
