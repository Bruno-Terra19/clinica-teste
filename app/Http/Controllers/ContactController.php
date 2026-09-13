<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contatos = Contact::orderBy('responded')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('contatos.index', compact('contatos'));
    }

    public function toggle(Contact $contact)
    {
        $contact->update(['responded' => !$contact->responded]);

        $msg = $contact->responded ? 'Contato marcado como respondido.' : 'Contato reaberto.';
        return redirect()->route('contatos.index')->with('status', $msg);
    }
}