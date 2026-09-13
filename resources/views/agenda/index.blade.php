@extends('layouts.painel')
@section('title', 'Agenda')

@section('content')
    <section class="agenda">
        @forelse ($agendamentos as $dia => $doDia)
            <div class="agenda-dia">
                <h2 class="agenda-data">
                    {{ \Carbon\Carbon::parse($dia)->translatedFormat('l, d/m/Y') }}
                </h2>

                @foreach ($doDia as $ag)
                    <div class="agenda-item">
                        <span class="agenda-hora">{{ $ag->scheduled_at->format('H:i') }}</span>
                        <span class="agenda-paciente">{{ $ag->patient->name }}</span>
                        <span class="agenda-status">{{ $ag->status }}</span>
                    </div>
                @endforeach
            </div>
        @empty
            <p>Nenhum agendamento futuro.</p>
        @endforelse
    </section>
@endsection