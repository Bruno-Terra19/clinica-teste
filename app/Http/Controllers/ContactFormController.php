<?php

namespace App\Http\Controllers;

use App\Mail\ContatoRecebido;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        // 1. confere o token secreto
        $token = $request->header('X-Contact-Token') ?? $request->input('token');

        if (!$token || $token !== config('services.contact_form.token')) {
            return response()->json(['message' => 'Não autorizado.'], 401);
        }

        // 2. valida os dados (nome + whatsapp; email e message opcionais)
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        // 3. monta o registro pro banco (a tabela contacts tem name/email/message)
        $contact = Contact::create([
            'name' => $dados['name'],
            'email' => $dados['email'] ?? null,
            'message' => $dados['message'] ?? ('Contato via site. WhatsApp: ' . $dados['whatsapp']),
        ]);

        return response()->json([
            'message' => 'Contato recebido com sucesso.',
            'id' => $contact->id,
        ], 201);
    }
}