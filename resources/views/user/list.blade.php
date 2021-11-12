
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
    @forelse($user_list as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->formatted_cpf }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->formatted_phone }}</td>
            <td>{{ $user->formatted_birth }}</td>
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
