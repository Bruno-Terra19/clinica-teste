<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAgendamentos = Appointment::count();
        $agendamentosHoje = Appointment::whereDate('scheduled_at', today())->count();
        $novosPacientes = Patient::where('created_at', '>=', now()->subDays(30))->count();

        $confirmados = Appointment::where('status', 'confirmed')->count();
        $taxaConfirmacao = $totalAgendamentos > 0
            ? round($confirmados / $totalAgendamentos * 100)
            : 0;

        $proximos = Appointment::with('patient')
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        return view('painel.dashboard', compact(
            'totalAgendamentos',
            'agendamentosHoje',
            'novosPacientes',
            'taxaConfirmacao',
            'proximos'
        ));
    }
}