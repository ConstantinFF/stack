<?php

namespace Stack\Controllers;

use Stack\Models\User;
use Stack\Services\Mail\MailInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateAccount extends Controller
{
    private $request;

    private $mail;

    public function __construct(Request $request, MailInterface $mail)
    {
        $this->request = $request;
        $this->mail = $mail;
    }

    public function __invoke()
    {
        $user = User::create($this->request->request->all());

        $this->mail
            ->create('emails/registered', ['user' => $user])
            ->from('no-reply@stack.example')
            ->to($user->email)
            ->send();
            
        return redirect('login');
    }
}
