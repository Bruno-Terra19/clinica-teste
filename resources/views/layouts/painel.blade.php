{{-- Layout do painel — identidade Caroline (nude/dourado + Playfair/Montserrat) --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel') · Clínica Teste</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream font-body text-espresso antialiased">
    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 shrink-0 bg-white border-r border-nude/30 flex flex-col">
            <div class="px-6 py-7">
                <span class="font-display text-xl text-espresso">Clínica Teste</span>
            </div>

            <nav class="flex-1 px-4 py-2 space-y-1">
                @php
                    $link = 'flex items-center gap-3 px-4 py-2.5 rounded-brand-sm text-sm font-medium transition-colors';
                    $active = 'bg-blush/50 text-gold-deep';
                    $idle = 'text-taupe hover:bg-blush/30 hover:text-espresso';
                @endphp

                <a href="{{ route('painel.index') }}"
                    class="{{ $link }} {{ request()->routeIs('painel.index') ? $active : $idle }}">Visão Geral</a>
                <a href="{{ route('pacientes.index') }}"
                    class="{{ $link }} {{ request()->routeIs('pacientes.*') ? $active : $idle }}">Pacientes</a>
                <a href="{{ route('agenda.index') }}"
                    class="{{ $link }} {{ request()->routeIs('agenda.*') ? $active : $idle }}">Agenda</a>
                <a href="{{ route('contatos.index') }}"
                    class="{{ $link }} {{ request()->routeIs('contatos.*') ? $active : $idle }}">Contatos</a>
                <a href="{{ route('configuracoes.edit') }}"
                    class="{{ $link }} {{ request()->routeIs('configuracoes.*') ? $active : $idle }}">Configurações</a>
            </nav>

            <div class="px-4 py-5 border-t border-nude/30">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2.5 rounded-brand-sm text-sm font-medium text-taupe hover:bg-blush/30 hover:text-espresso transition-colors">
                        Sair
                    </button>
                </form>
            </div>
        </aside>

        {{-- CONTEÚDO --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="px-8 py-6 flex items-center justify-between">
                <h1 class="font-display italic text-3xl text-espresso">@yield('title', 'Painel')</h1>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-taupe">Olá, {{ auth()->user()->name }}</span>
                    <div
                        class="w-9 h-9 rounded-full bg-gold/15 text-gold-deep flex items-center justify-center font-display italic text-sm">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            @if (session('status'))
                <div class="mx-8 mb-2 rounded-brand-sm bg-blush/50 border border-nude/40 text-gold-deep px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <main class="flex-1 px-8 pb-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>