<?php

namespace Somecode\Framework\Http\Middleware;

use Somecode\Framework\Authentication\SessionAuthInterface;
use Somecode\Framework\Http\RedirectResponse;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;
use Somecode\Framework\Session\SessionInterface;

class Authenticate implements MiddlewareInterface
{
    private bool $authenticated = true;

    public function __construct(
        private SessionAuthInterface $auth,
        private SessionInterface $session
    ) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $this->session->start();
        if (! $this->auth->check()) {
            $this->session->setFlash('error', 'You need to be logged in to access this page.');

            return new RedirectResponse('/login');
        }

        return $handler->handle($request);
    }
}
