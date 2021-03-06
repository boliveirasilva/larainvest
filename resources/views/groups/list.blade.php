
<table class="default-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome do Grupo</th>
        <th>Total da Pool</th>
        <th>Instituição</th>
        <th>Responsável</th>
        <th>Opções</th>
    </tr>
    </thead>
    <tbody>
    @forelse($group_list as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>R$ {{ number_format($group->pool_value, 2, ',', '.') }}</td>
            <td>{{ $group->institution->name }}</td>
            <td>{{ $group->owner->name }}</td>
            <td>
                {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'delete']) !!}
                {!! Form::submit('Remover') !!}
                {!! Form::close() !!}
                <a href="{{ route('group.edit', $group->id) }}">Editar</a>
                <a href="{{ route('group.show', $group->id) }}">Detalhes</a>
            </td>
        </tr>
    @empty
        <tr class="empty-table"><td colspan="3">Nenhum registro encontrado!</td></tr>
    @endforelse
    </tbody>
</table>
