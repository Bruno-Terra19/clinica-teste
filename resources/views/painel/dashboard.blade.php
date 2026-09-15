@extends('layouts.painel')
@section('title', 'Visão Geral')

@section('content')
    {{-- Cards de estatística --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

        {{-- Card em destaque (espresso) --}}
        <div class="bg-espresso text-white rounded-brand p-6 shadow-soft">
            <span class="text-sm text-white/60">Total de agendamentos</span>
            <p class="font-display text-4xl mt-2">{{ $totalAgendamentos }}</p>
        </div>

        {{-- Cards claros --}}
        <div class="bg-white rounded-brand p-6 border border-nude/30 shadow-soft">
            <span class="text-sm text-taupe">Agendamentos hoje</span>
            <p class="font-display text-4xl mt-2 text-espresso">{{ $agendamentosHoje }}</p>
        </div>

        <div class="bg-white rounded-brand p-6 border border-nude/30 shadow-soft">
            <span class="text-sm text-taupe">Novos pacientes (30 dias)</span>
            <p class="font-display text-4xl mt-2 text-espresso">{{ $novosPacientes }}</p>
        </div>

        <div class="bg-white rounded-brand p-6 border border-nude/30 shadow-soft">
            <span class="text-sm text-taupe">Taxa de confirmação</span>
            <p class="font-display text-4xl mt-2 text-espresso">{{ $taxaConfirmacao }}%</p>
        </div>
    </section>

    {{-- Próximos agendamentos --}}
    <section class="bg-white rounded-brand border border-nude/30 shadow-soft overflow-hidden">
        <div class="px-6 py-5 border-b border-nude/20">
            <h2 class="font-display italic text-xl text-espresso">Próximos agendamentos</h2>
        </div>

        <div class="divide-y divide-nude/15">
            @forelse ($proximos as $ag)
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-blush/60 text-gold-deep flex items-center justify-center font-display italic">
                            {{ mb_substr($ag->patient->name, 0, 1) }}
                        </div>
                        <span class="font-medium text-espresso">{{ $ag->patient->name }}</span>
                    </div>
                    <div class="flex items-center gap-6">
                        <span class="text-sm text-taupe">{{ $ag->scheduled_at->format('d/m/Y H:i') }}</span>
                        <span class="text-xs px-3 py-1 rounded-full bg-blush/50 text-gold-deep font-medium">
                            {{ $ag->status }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="px-6 py-8 text-center text-taupe">Nenhum agendamento futuro ainda.</p>
            @endforelse
        </div>
    </section>
@endsection