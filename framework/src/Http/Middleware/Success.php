<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class Success implements MiddlewareInterface
{
    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        return new Response('Hello World!');
    }
}
