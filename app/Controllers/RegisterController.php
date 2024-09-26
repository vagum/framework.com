<?php

namespace App\Controllers;

use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class RegisterController extends AbstractController
{
    public function form(): Response
    {
        return $this->render('register.html.twig');
    }

    public function register()
    {
        dd($this->request);
    }
}
