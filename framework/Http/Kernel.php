<?php

namespace Somecode\Framework\Http;

use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {

            $collector->get('/', function () {
                $content = '<h1>Some Content</h1>';

                return new Response($content);
            });

            $collector->get('/posts/{id}', function (array $vars) {
                $content = '<h1>Posts - '.$vars['id'].'</h1>';

                return new Response($content);
            });

        });

        $routeInfo = $dispatcher->dispatch(
            $request->server['REQUEST_METHOD'],
            $request->server['REQUEST_URI'],
        );

        [$status, $handler, $vars] = $routeInfo;

        return $handler($vars);
    }
}
