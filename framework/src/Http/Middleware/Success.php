<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class Success implements RequestHandlerInterface
{
    public function handle(Request $request): Response
    {
        return new Response('Hello World!');
    }
}
