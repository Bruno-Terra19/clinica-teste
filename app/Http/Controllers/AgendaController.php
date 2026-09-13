<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class AgendaController extends Controller
{
    public function index()
    {
        $agendamentos = Appointment::with('patient')
            ->where('scheduled_at', '>=', now()->startOfDay())
            ->orderBy('scheduled_at')
            ->get()
            ->groupBy(fn($ag) => $ag->scheduled_at->format('Y-m-d'));

        return view('agenda.index', compact('agendamentos'));
    }
}