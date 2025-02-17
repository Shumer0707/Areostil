<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
// Dashboard
// Route::get('/dashboard', function () {dd(Auth::check());})->name('dashboard');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth:admin'])->name('dashboard');
// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

// Профиль пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth (логин, регистрация)
require __DIR__.'/auth.php';

// API маршруты
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/test', TestController::class);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
});

// Этот маршрут ДОЛЖЕН быть последним
Route::get('/{any}', function () {
    return Inertia::render('App'); // Твой основной Vue компонент
})->where('any', '.*');


