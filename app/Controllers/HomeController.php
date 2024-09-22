<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly YouTubeService $youTube,
    ) {}

    public function index(): Response
    {
        dd($this->container->get('twig'));

        $content = '<h1>Hello, World!!!</h1><br>';
        $content .= '<a href="'.$this->youTube->getChannelUrl().'">YouTube Channel</a>';

        return new Response($content);
    }
}
