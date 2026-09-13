<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $pacientes = Patient::orderBy('name')->paginate(15);
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        Patient::create($this->validated($request));
        return redirect()->route('pacientes.index')->with('status', 'Paciente cadastrado.');
    }

    public function edit(Patient $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Patient $paciente)
    {
        $paciente->update($this->validated($request));
        return redirect()->route('pacientes.index')->with('status', 'Paciente atualizado.');
    }

    public function destroy(Patient $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('status', 'Paciente excluído.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'last_visit_at' => 'nullable|date',
        ]);
    }
}