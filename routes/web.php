<?php

use Somecode\Framework\Routing\Route;

return [
    Route::GET('/', ['HomeController::class', 'index']),
];
