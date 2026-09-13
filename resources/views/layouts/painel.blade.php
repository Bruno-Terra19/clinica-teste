{{-- Layout base do painel (cru — sem estilo, só estrutura) --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel') · Clínica Teste</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="painel">
        <aside class="painel-sidebar">
            <div class="painel-logo">Clínica Teste</div>
            <nav>
                <a href="{{ route('painel.index') }}">Visão Geral</a>
                <a href="{{ route('pacientes.index') }}">Pacientes</a>
                <a href="{{ route('agenda.index') }}">Agenda</a>
                <a href="{{ route('contatos.index') }}">Contatos</a>
                <a href="{{ route('configuracoes.edit') }}">Configurações</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </aside>

        <div class="painel-main">
            <header class="painel-header">
                <h1>@yield('title', 'Painel')</h1>
                <span>Olá, {{ auth()->user()->name }}</span>
            </header>

            @if (session('status'))
                <div class="flash">{{ session('status') }}</div>
            @endif

            <main class="painel-content">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>