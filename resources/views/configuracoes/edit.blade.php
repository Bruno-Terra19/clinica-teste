@extends('layouts.painel')
@section('title', 'Configurações')

@section('content')
    {{-- Dados da clínica --}}
    <section class="config-clinica">
        <h2>Dados da clínica</h2>
        <form method="POST" action="{{ route('configuracoes.update') }}">
            @csrf
            @method('PUT')
            <div>
                <label for="clinic_name">Nome da clínica</label>
                <input type="text" name="clinic_name" id="clinic_name"
                    value="{{ old('clinic_name', $config->clinic_name) }}" required>
                @error('clinic_name') <span class="erro">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="calcom_link">Link do Cal.com</label>
                <input type="url" name="calcom_link" id="calcom_link" value="{{ old('calcom_link', $config->calcom_link) }}"
                    placeholder="https://cal.com/teste">
                @error('calcom_link') <span class="erro">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="whatsapp_number">WhatsApp (notificações)</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number"
                    value="{{ old('whatsapp_number', $config->whatsapp_number) }}" placeholder="5575981157345">
                @error('whatsapp_number') <span class="erro">{{ $message }}</span> @enderror
            </div>
            <button type="submit">Salvar dados da clínica</button>
        </form>
    </section>

    {{-- Trocar senha — usa a rota do Breeze (password.update) --}}
    <section class="config-senha">
        <h2>Trocar senha</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            <div>
                <label for="current_password">Senha atual</label>
                <input type="password" name="current_password" id="current_password">
                @error('current_password', 'updatePassword')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password">Nova senha</label>
                <input type="password" name="password" id="password">
                @error('password', 'updatePassword')
                    <span class="erro">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirmar nova senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <button type="submit">Atualizar senha</button>
        </form>
    </section>
@endsection