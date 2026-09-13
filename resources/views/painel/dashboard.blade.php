@extends('layouts.painel')
@section('title', 'Visão Geral')

@section('content')
    <section class="stats">
        <div class="stat-card">
            <span class="stat-label">Total de agendamentos</span>
            <strong class="stat-value">{{ $totalAgendamentos }}</strong>
        </div>
        <div class="stat-card">
            <span class="stat-label">Agendamentos hoje</span>
            <strong class="stat-value">{{ $agendamentosHoje }}</strong>
        </div>
        <div class="stat-card">
            <span class="stat-label">Novos pacientes (30 dias)</span>
            <strong class="stat-value">{{ $novosPacientes }}</strong>
        </div>
        <div class="stat-card">
            <span class="stat-label">Taxa de confirmação</span>
            <strong class="stat-value">{{ $taxaConfirmacao }}%</strong>
        </div>
    </section>

    <section class="proximos">
        <h2>Próximos agendamentos</h2>
        @forelse ($proximos as $ag)
            <div class="ag-item">
                <span>{{ $ag->patient->name }}</span>
                <span>{{ $ag->scheduled_at->format('d/m/Y H:i') }}</span>
                <span>{{ $ag->status }}</span>
            </div>
        @empty
            <p>Nenhum agendamento futuro ainda.</p>
        @endforelse
    </section>
@endsection