@csrf
<div>
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="{{ old('name', $paciente->name ?? '') }}" required>
    @error('name') <span class="erro">{{ $message }}</span> @enderror
</div>
<div>
    <label for="phone">Telefone</label>
    <input type="text" name="phone" id="phone" value="{{ old('phone', $paciente->phone ?? '') }}">
    @error('phone') <span class="erro">{{ $message }}</span> @enderror
</div>
<div>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" value="{{ old('email', $paciente->email ?? '') }}">
    @error('email') <span class="erro">{{ $message }}</span> @enderror
</div>
<div>
    <label for="last_visit_at">Última consulta</label>
    <input type="date" name="last_visit_at" id="last_visit_at"
        value="{{ old('last_visit_at', isset($paciente) && $paciente->last_visit_at ? $paciente->last_visit_at->format('Y-m-d') : '') }}">
    @error('last_visit_at') <span class="erro">{{ $message }}</span> @enderror
</div>