<?php

namespace App\Http\Controllers;

use App\Models\ClinicSetting;
use Illuminate\Http\Request;

class ClinicSettingController extends Controller
{
    public function edit()
    {
        $config = ClinicSetting::firstOrCreate([]);
        return view('configuracoes.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $dados = $request->validate([
            'clinic_name' => 'required|string|max:255',
            'calcom_link' => 'nullable|url|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        ClinicSetting::firstOrCreate([])->update($dados);

        return redirect()->route('configuracoes.edit')->with('status', 'Configurações salvas.');
    }
}