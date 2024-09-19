<?php

namespace Somecode\Framework\Http;

use Somecode\Framework\Http\Exceptions\HttpException;
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
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Throwable $e) {
            $response = new Response($e->getMessage(), statusCode: 500);
        }

        return $response;
    }
}
