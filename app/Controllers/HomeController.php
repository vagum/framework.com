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

        $content = '<h1>Hello, World!!!</h1><br>';
        $content .= '<a href="{{ youTubeChannel }}">YouTube Channel</a>';

        return $this->render($content, [
            'youTubeChannel' => $this->youTube->getChannelUrl(),
        ]);
    }
}
