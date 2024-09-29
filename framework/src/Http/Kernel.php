<?php

namespace Somecode\Framework\Http;

use League\Container\Container;
use Somecode\Framework\Event\EventDispatcher;
use Somecode\Framework\Http\Events\ResponseEvent;
use Somecode\Framework\Http\Exceptions\HttpException;
use Somecode\Framework\Http\Middleware\RequestHandlerInterface;

class Kernel
{
    private string $appEnv = 'production';

    public function __construct(
        private readonly Container $container,
        private readonly RequestHandlerInterface $requestHandler,
        private readonly EventDispatcher $eventDispatcher
    ) {
        $this->appEnv = $this->container->get('APP_ENV');
    }

    public function handle(Request $request): Response
    {
        try {
            $response = $this->requestHandler->handle($request);
        } catch (\Exception $e) {
            $response = $this->createExceptionResponse($e);
        }

        $this->eventDispatcher->dispatch(new ResponseEvent($request, $response));

        return $response;
    }

    public function terminate(Request $request, Response $response): void
    {
        $request->getSession()?->clearFlash();
    }

    private function createExceptionResponse(\Exception $e): Response
    {
        if (in_array($this->appEnv, ['local', 'testing'])) {
            throw $e;
        }
        if ($e instanceof HttpException) {
            return new Response($e->getMessage(), $e->getStatusCode());
        }

        return new Response('Server Error', 500);
    }
}
