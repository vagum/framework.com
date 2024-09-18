<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Somecode\Framework\Http\Request;

$request = Request::createFromGlobals();

dd($request);
