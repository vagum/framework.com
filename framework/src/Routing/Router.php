<?php

namespace Somecode\Framework\Routing;

use League\Container\Container;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Request;

class Router implements RouterInterface
{
    private array $routes;

    public function dispatch(Request $request, Container $container): array
    {
        $handler = $request->getRouteHandler();
        $vars = $request->getRouteArgs();

        if (is_array($handler)) {

            [$controllerId,$method] = $handler;
            $controller = $container->get($controllerId);

            if (is_subclass_of($controller, AbstractController::class)) {
                $controller->setRequest($request);
            }

            $handler = [$controller, $method];
        }

        return [$handler, $vars];
    }
}
