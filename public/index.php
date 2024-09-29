<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';

use Somecode\Framework\Event\EventDispatcher;
use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;

$request = Request::createFromGlobals();

/** @var League\Container\Container $container */
$container = require BASE_PATH.'/config/services.php';

$eventDispatcher = $container->get(EventDispatcher::class);
$eventDispatcher->addListener(
    \Somecode\Framework\Http\Events\ResponseEvent::class,
    new \App\Listeners\ContentLengthListener
);

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
