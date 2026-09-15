@extends('layouts.painel')
@section('title', 'Pacientes')

@section('content')
    <div class="flex justify-end mb-5">
        <a href="{{ route('pacientes.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-brand-sm bg-espresso text-white text-sm font-medium hover:bg-mocha transition-colors">
            + Novo paciente
        </a>
    </div>

    <div class="bg-white rounded-brand border border-nude/30 shadow-soft overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-taupe border-b border-nude/20">
                    <th class="px-6 py-4 font-medium">Nome</th>
                    <th class="px-6 py-4 font-medium">Telefone</th>
                    <th class="px-6 py-4 font-medium">E-mail</th>
                    <th class="px-6 py-4 font-medium">Última consulta</th>
                    <th class="px-6 py-4 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-nude/15">
                @forelse ($pacientes as $p)
                    <tr class="hover:bg-cream/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-espresso">{{ $p->name }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $p->phone ?: '—' }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $p->email ?: '—' }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $p->last_visit_at?->format('d/m/Y') ?: '—' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('pacientes.edit', $p) }}" class="text-gold-deep hover:underline">Editar</a>
                                <form method="POST" action="{{ route('pacientes.destroy', $p) }}"
                                    onsubmit="return confirm('Excluir este paciente?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose hover:underline">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-taupe">Nenhum paciente cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $pacientes->links() }}</div>
@endsection