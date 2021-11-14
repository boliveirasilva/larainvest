@extends('templates.master')

@php
    $product_list = (empty($product_list) ? [] : $product_list);
@endphp

@section('content-view')
    @if(session('flash_message'))
        <h3>{{ session('flash_message')['messages'] }}</h3>
        <hr>
    @endif

    <table class="default-table">
        <thead>
        <tr>
            <th>Produto</th>
            <th>Instituição</th>
            <th>Valor Investido</th>
        </tr>
        </thead>
        <tbody>
        @forelse($product_list as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->institution->name }}</td>
            <td>R$ {{ number_format($product->valueFromUser(Auth::user()), 2, ',', '.') }}</td>
        </tr>
        @empty
            <tr class="empty-table"><td colspan="3">Nenhum registro encontrado!</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection