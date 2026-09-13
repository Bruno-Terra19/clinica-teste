@extends('layouts.painel')
@section('title', 'Novo paciente')

@section('content')
    <form method="POST" action="{{ route('pacientes.store') }}">
        @include('pacientes._form')
        <button type="submit">Salvar</button>
        <a href="{{ route('pacientes.index') }}">Cancelar</a>
    </form>
@endsection