<?php

namespace Somecode\Framework\Controller;

use Psr\Container\ContainerInterface;
use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

    protected Request $request;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function render(string $view, array $parameters = [], ?Response $response = null): Response
    {
        $content = $this->container->get('twig')->render($view, $parameters);

        $response ??= new Response;

        $response->setContent($content);

        return $response;
    }
}
