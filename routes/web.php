<?php

use App\Controllers\HomeController;
use Somecode\Framework\Routing\Route;

return [
    Route::GET('/', [HomeController::class, 'index']),
];
