@extends('templates.master')

@php
    $movement_list = (empty($movement_list) ? [] : $movement_list);
@endphp

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message')['messages'] }}</h3>
        <hr>
    @endif

    <table class="default-table">
        <thead>
        <tr>
            <th>Data</th>
            <th>Tipo</th>
            <th>Produto</th>
            <th>Grupo</th>
            <th>Valor</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($movement_list as $movement)
        <tr>
            <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $movement->type == 1 ? "Aplicação" : "Resgate" }}</td>
            <td>{{ $movement->product->name }}</td>
            <td>{{ $movement->group->name }}</td>
            <td>R$ {{ number_format($movement->value, 2, ',', '.') }}</td>
            <td>---</td>
        </tr>
        @empty
            <tr class="empty-table"><td colspan="3">Nenhum registro encontrado!</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection