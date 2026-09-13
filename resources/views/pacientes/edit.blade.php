@extends('layouts.painel')
@section('title', 'Editar paciente')

@section('content')
    <form method="POST" action="{{ route('pacientes.update', $paciente) }}">
        @method('PUT')
        @include('pacientes._form')
        <button type="submit">Atualizar</button>
        <a href="{{ route('pacientes.index') }}">Cancelar</a>
    </form>
@endsection