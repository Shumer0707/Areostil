<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


// API маршруты
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/test', TestController::class);
});

// Маршруты для SPA
Route::get('/{any}', function () {
    return view('layouts.main'); // Vue SPA приложение
})->where('any', '.*');
