<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Somecode\Framework\Http\Request;
use Somecode\Framework\Http\Response;

$request = Request::createFromGlobals();

$content = '<h1>Hello World!</h1>';
$response = new Response($content, 200, []);
$response->send();
