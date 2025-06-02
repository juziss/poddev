
@extends('layouts.main')

@section('title', 'Espisódios')

@section('content')

    <h1>Lista de Episódios</h1>

    @if($busca != '')
        <p>O usuário está buscando por: {{ $busca }}</p>

    @endif
@endsection