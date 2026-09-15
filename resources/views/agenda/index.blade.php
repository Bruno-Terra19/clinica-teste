@extends('layouts.painel')
@section('title', 'Agenda')

@section('content')
    <section class="space-y-6">
        @forelse ($agendamentos as $dia => $doDia)
            <div class="bg-white rounded-brand border border-nude/30 shadow-soft overflow-hidden">
                <div class="px-6 py-4 bg-cream/60 border-b border-nude/20">
                    <h2 class="font-display italic text-lg text-espresso capitalize">
                        {{ \Carbon\Carbon::parse($dia)->translatedFormat('l, d/m/Y') }}
                    </h2>
                </div>
                <div class="divide-y divide-nude/15">
                    @foreach ($doDia as $ag)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <span class="font-display text-lg text-gold-deep w-16">{{ $ag->scheduled_at->format('H:i') }}</span>
                            <span class="flex-1 font-medium text-espresso">{{ $ag->patient->name }}</span>
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-blush/50 text-gold-deep font-medium">{{ $ag->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white rounded-brand border border-nude/30 shadow-soft px-6 py-10 text-center text-taupe">
                Nenhum agendamento futuro.
            </div>
        @endforelse
    </section>
@endsection