@csrf
@php
    $label = 'block text-sm font-medium text-mocha mb-1.5';
    $input = 'w-full rounded-brand-sm border-nude/40 bg-white text-espresso focus:border-gold focus:ring-gold/30';
    $erro = 'text-rose text-xs mt-1';
@endphp

<div class="space-y-4">
    <div>
        <label for="name" class="{{ $label }}">Nome</label>
        <input type="text" name="name" id="name" class="{{ $input }}" value="{{ old('name', $paciente->name ?? '') }}"
            required>
        @error('name') <span class="{{ $erro }}">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="phone" class="{{ $label }}">Telefone</label>
        <input type="text" name="phone" id="phone" class="{{ $input }}"
            value="{{ old('phone', $paciente->phone ?? '') }}">
        @error('phone') <span class="{{ $erro }}">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="email" class="{{ $label }}">E-mail</label>
        <input type="email" name="email" id="email" class="{{ $input }}"
            value="{{ old('email', $paciente->email ?? '') }}">
        @error('email') <span class="{{ $erro }}">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="last_visit_at" class="{{ $label }}">Última consulta</label>
        <input type="date" name="last_visit_at" id="last_visit_at" class="{{ $input }}"
            value="{{ old('last_visit_at', isset($paciente) && $paciente->last_visit_at ? $paciente->last_visit_at->format('Y-m-d') : '') }}">
        @error('last_visit_at') <span class="{{ $erro }}">{{ $message }}</span> @enderror
    </div>
</div>