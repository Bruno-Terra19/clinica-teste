<!DOCTYPE html>
<html lang="pt-BR">

<body>
    <p>Olá, {{ $contact->name }}!</p>

    <p>Recebemos sua mensagem e agradecemos o contato. Vamos responder em breve.</p>

    <p><strong>Sua mensagem:</strong><br>
        {{ $contact->message }}
    </p>

    <p>Atenciosamente,<br>
        Clínica Teste</p>
</body>

</html>