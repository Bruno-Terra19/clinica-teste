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

        // 2. valida os dados
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // 3. salva na tabela contacts
        $contact = Contact::create($dados);

        Mail::to($contact->email)->send(new ContatoRecebido($contact));

        return response()->json([
            'message' => 'Contato recebido com sucesso.',
            'id' => $contact->id,
        ], 201);
    }
}