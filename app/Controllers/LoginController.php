<?php

namespace App\Controllers;

use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class LoginController extends AbstractController
{
    public function form(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login()
    {
        dd($this->request);
    }
}
