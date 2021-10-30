@extends('templates.master')

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message') }}</h3>
    @endif

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['input' => 'cpf', 'attributes' => ['placeholder' => 'CPF']])
        @include('templates.formulario.input', ['input' => 'name', 'attributes' => ['placeholder' => 'Nome Completo']])
        @include('templates.formulario.input', ['input' => 'phone', 'attributes' => ['placeholder' => 'Telefone']])
        @include('templates.formulario.input', ['input' => 'email', 'attributes' => ['placeholder' => 'E-mail']])
        @include('templates.formulario.password', ['input' => 'password', 'attributes' => ['placeholder' => 'Senha']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    <table class="default-table">
        <thead>
        <tr>
            <th>#</th>
            <th>CPF</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Permissão</th>
            <th>Menu</th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->cpf }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->birth }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->permission }}</td>
                <td>
                    {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Remover') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr><td colspan="8">Nenhum usuário encontrado!</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection