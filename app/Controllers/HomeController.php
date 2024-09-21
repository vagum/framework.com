<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Somecode\Framework\Http\Response;
use Twig\Environment;

class HomeController
{
    public function __construct(
        private readonly YouTubeService $youTube,
        private readonly Environment $twig,
    ) {}

    public function index(): Response
    {
        dd($this->twig);
        $content = '<h1>Hello, World!!!</h1><br>';
        $content .= '<a href="'.$this->youTube->getChannelUrl().'">YouTube Channel</a>';

        return new Response($content);
    }
}
