<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProjectController;


// API маршруты
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/test', TestController::class);
    Route::get('/projects/{id}', [ProjectController::class, 'show']); // Новый маршрут для проекта
});

// Маршруты для SPA
Route::get('/{any}', function () {
    return view('layouts.main'); // Vue SPA приложение
})->where('any', '.*');
