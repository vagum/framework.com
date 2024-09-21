<?php

use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Routing\Router;
use Somecode\Framework\Routing\RouterInterface;

// Application parameters

$routes = include BASE_PATH.'/routes/web.php';

// Application services

$container = new Container;
$container->add(RouterInterface::class, Router::class);
$container->extend(RouterInterface::class)->addMethodCall('registerRoutes', [new ArrayArgument($routes)]);
$container->add(Kernel::class)->addArgument(RouterInterface::class);

return $container;
