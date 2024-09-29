<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Authentication\SessionAuthInterface;
use Somecode\Framework\Http\RedirectResponse;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;
use Somecode\Framework\Session\SessionInterface;

class Guest implements MiddlewareInterface
{
    private bool $authenticated = true;

    public function __construct(
        private SessionAuthInterface $auth,
        private SessionInterface $session
    ) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $this->session->start();
        if ($this->auth->check()) {
            return new RedirectResponse('/dashboard');
        }

        return $handler->handle($request);
    }
}
