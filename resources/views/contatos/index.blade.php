@extends('layouts.painel')
@section('title', 'Contatos')

@section('content')
    <table class="tabela-contatos">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Mensagem</th>
                <th>Recebido em</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contatos as $c)
                <tr class="{{ $c->responded ? 'contato-respondido' : 'contato-pendente' }}">
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->message }}</td>
                    <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $c->responded ? 'Respondido' : 'Pendente' }}</td>
                    <td>
                        <form method="POST" action="{{ route('contatos.toggle', $c) }}">
                            @csrf @method('PATCH')
                            <button type="submit">
                                {{ $c->responded ? 'Reabrir' : 'Marcar como respondido' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma mensagem recebida ainda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $contatos->links() }}
@endsection