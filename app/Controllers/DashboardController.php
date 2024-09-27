<?php

namespace App\Controllers;

use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class DashboardController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('dashboard.html.twig');
    }
}
