<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CalcomWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Confere a assinatura: prova que o aviso veio mesmo do Cal.com
        $assinatura = $request->header('X-Cal-Signature-256');
        $esperada = hash_hmac('sha256', $request->getContent(), config('services.calcom.webhook_secret'));

        if (!$assinatura || !hash_equals($esperada, $assinatura)) {
            return response()->json(['message' => 'Assinatura inválida.'], 401);
        }

        // Legítimo: dispara a sincronização (reaproveita o calcom:sync inteiro)
        Artisan::call('calcom:sync');

        return response()->json(['ok' => true]);
    }
}