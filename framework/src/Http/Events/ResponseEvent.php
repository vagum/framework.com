<?php

namespace Somecode\Framework\Http\Events;

use Somecode\Framework\Event\Event;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

class ResponseEvent extends Event
{
    public function __construct(
        private readonly Request $request,
        private readonly Response $response,
    ) {}

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}
