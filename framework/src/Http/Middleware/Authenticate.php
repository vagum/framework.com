<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class Authenticate implements MiddlewareInterface
{
    private bool $authenticated = true;

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        if (! $this->authenticated) {
            return new Response('Authentication Required', 401);
        }

        return $handler->handle($request);
    }
}
