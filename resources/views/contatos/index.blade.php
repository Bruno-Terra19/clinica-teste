@extends('layouts.painel')
@section('title', 'Contatos')

@section('content')
    <div class="bg-white rounded-brand border border-nude/30 shadow-soft overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-taupe border-b border-nude/20">
                    <th class="px-6 py-4 font-medium">Nome</th>
                    <th class="px-6 py-4 font-medium">E-mail</th>
                    <th class="px-6 py-4 font-medium">Mensagem</th>
                    <th class="px-6 py-4 font-medium">Recebido em</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-nude/15">
                @forelse ($contatos as $c)
                    <tr class="hover:bg-cream/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-espresso">{{ $c->name }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $c->email ?: '—' }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $c->message }}</td>
                        <td class="px-6 py-4 text-mocha">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs px-3 py-1 rounded-full font-medium
                                        {{ $c->responded ? 'bg-blush/50 text-gold-deep' : 'bg-rose/15 text-rose' }}">
                                {{ $c->responded ? 'Respondido' : 'Pendente' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{ route('contatos.toggle', $c) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-gold-deep hover:underline">
                                    {{ $c->responded ? 'Reabrir' : 'Marcar como respondido' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-taupe">Nenhuma mensagem recebida ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $contatos->links() }}</div>
@endsection