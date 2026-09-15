@extends('layouts.painel')
@section('title', 'Configurações')

@section('content')
    <div class="max-w-2xl space-y-6">
        @php
            $label = 'block text-sm font-medium text-mocha mb-1.5';
            $input = 'w-full rounded-brand-sm border-nude/40 bg-white text-espresso focus:border-gold focus:ring-gold/30';
            $erro = 'text-rose text-xs mt-1';
        @endphp

        {{-- Dados da clínica --}}
        <section class="bg-white rounded-brand border border-nude/30 shadow-soft p-6">
            <h2 class="font-display italic text-xl text-espresso mb-5">Dados da clínica</h2>
            <form method="POST" action="{{ route('configuracoes.update') }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label for="clinic_name" class="{{ $label }}">Nome da clínica</label>
                    <input type="text" name="clinic_name" id="clinic_name" class="{{ $input }}"
                        value="{{ old('clinic_name', $config->clinic_name) }}" required>
                    @error('clinic_name') <span class="{{ $erro }}">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="calcom_link" class="{{ $label }}">Link do Cal.com</label>
                    <input type="url" name="calcom_link" id="calcom_link" class="{{ $input }}"
                        value="{{ old('calcom_link', $config->calcom_link) }}" placeholder="https://cal.com/teste">
                    @error('calcom_link') <span class="{{ $erro }}">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="whatsapp_number" class="{{ $label }}">WhatsApp (notificações)</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="{{ $input }}"
                        value="{{ old('whatsapp_number', $config->whatsapp_number) }}" placeholder="5575981157345">
                    @error('whatsapp_number') <span class="{{ $erro }}">{{ $message }}</span> @enderror
                </div>
                <button type="submit"
                    class="px-5 py-2.5 rounded-brand-sm bg-espresso text-white text-sm font-medium hover:bg-mocha transition-colors">
                    Salvar dados da clínica
                </button>
            </form>
        </section>

        {{-- Trocar senha --}}
        <section class="bg-white rounded-brand border border-nude/30 shadow-soft p-6">
            <h2 class="font-display italic text-xl text-espresso mb-5">Trocar senha</h2>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label for="current_password" class="{{ $label }}">Senha atual</label>
                    <input type="password" name="current_password" id="current_password" class="{{ $input }}">
                    @error('current_password', 'updatePassword') <span class="{{ $erro }}">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="{{ $label }}">Nova senha</label>
                    <input type="password" name="password" id="password" class="{{ $input }}">
                    @error('password', 'updatePassword') <span class="{{ $erro }}">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="{{ $label }}">Confirmar nova senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="{{ $input }}">
                </div>
                <button type="submit"
                    class="px-5 py-2.5 rounded-brand-sm bg-espresso text-white text-sm font-medium hover:bg-mocha transition-colors">
                    Atualizar senha
                </button>
            </form>
        </section>
    </div>
@endsection