<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

// Route::get('/', [HomeController::class, 'index']) -> name('home.index');
// Route::get('/about', [AboutController::class, 'index']) -> name('about.index');
// Route::get('/galery', [GaleryController::class, 'index']) -> name('galery.index');
// Route::get('/contact', [ContactController::class, 'index']) -> name('contact.index');

// Route::middleware('api')->prefix('api')->group(function () {
//     Route::get('/test', TestController::class);
// });

// API маршруты
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/test', TestController::class);
});

// Маршруты для SPA
Route::get('/{any}', function () {
    return view('layouts.main'); // Vue SPA приложение
})->where('any', '.*');
