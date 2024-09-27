<?php

namespace App\Controllers;

use Somecode\Framework\Authentication\SessionAuthInterface;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class LoginController extends AbstractController
{
    public function __construct(
        private SessionAuthInterface $sessionAuth
    ) {}

    public function form(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login()
    {
        dd($this->sessionAuth->authenticate(
            $this->request->input('email'),
            $this->request->input('password'),

        )
        );
    }
}
