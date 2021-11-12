@extends('templates.master')

@section('content-view')
    <h1>{{ $institution->name }}</h1>

    @include('groups.list', ['group_list' => $institution->groups])
@endsection