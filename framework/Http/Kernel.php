<?php

namespace Somecode\Framework\Http;

use Somecode\Framework\Routing\RouterInterface;

class Kernel
{
    public function __construct(
        private RouterInterface $router,
    ) {}

    public function handle(Request $request): Response
    {
        try {

            [$routerHandler,$vars] = $this->router->dispatch($request);
            $response = call_user_func_array($routerHandler, $vars);
        } catch (\Throwable $exception) {
            $response = new Response($exception->getMessage(), statusCode: 500);
        }

        return $response;
    }
}
