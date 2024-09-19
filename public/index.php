<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';

use Somecode\Framework\Http\Kernel;
use Somecode\Framework\Http\Request;

$request = Request::createFromGlobals();

$kernel = new Kernel;
$response = $kernel->handle($request);
$response->send();
