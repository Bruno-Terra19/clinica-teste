@extends('layouts.painel')
@section('title', 'Novo paciente')

@section('content')
    <div class="max-w-xl bg-white rounded-brand border border-nude/30 shadow-soft p-6">
        <form method="POST" action="{{ route('pacientes.store') }}">
            @include('pacientes._form')
            <div class="flex items-center gap-3 mt-6">
                <button type="submit"
                    class="px-5 py-2.5 rounded-brand-sm bg-espresso text-white text-sm font-medium hover:bg-mocha transition-colors">
                    Salvar
                </button>
                <a href="{{ route('pacientes.index') }}" class="text-sm text-taupe hover:text-espresso">Cancelar</a>
            </div>
        </form>
    </div>
@endsection