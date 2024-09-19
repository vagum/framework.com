<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use Somecode\Framework\Routing\Route;

return [
    Route::GET('/', [HomeController::class, 'index']),
    Route::GET('/posts/{id:\d+}', [PostController::class, 'show']),
];
