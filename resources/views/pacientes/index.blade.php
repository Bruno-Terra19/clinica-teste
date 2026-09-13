@extends('layouts.painel')
@section('title', 'Pacientes')

@section('content')
    <a href="{{ route('pacientes.create') }}">+ Novo paciente</a>

    <table class="tabela-pacientes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Última consulta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pacientes as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->phone ?: '—' }}</td>
                    <td>{{ $p->email ?: '—' }}</td>
                    <td>{{ $p->last_visit_at?->format('d/m/Y') ?: '—' }}</td>
                    <td>
                        <a href="{{ route('pacientes.edit', $p) }}">Editar</a>
                        <form method="POST" action="{{ route('pacientes.destroy', $p) }}"
                            onsubmit="return confirm('Excluir este paciente?')">
                            @csrf @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum paciente cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pacientes->links() }}
@endsection