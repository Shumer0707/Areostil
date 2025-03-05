<?php

use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ContactController;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth:admin'])->name('dashboard');

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/projects', [ProjectAdminController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectAdminController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectAdminController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{id}/edit', [ProjectAdminController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [ProjectAdminController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [ProjectAdminController::class, 'destroy'])->name('admin.projects.destroy');
    Route::get('/projects/{id}/images', [ProjectAdminController::class, 'images'])->name('admin.projects.images');
    Route::post('/projects/{id}/images', [ProjectAdminController::class, 'uploadImage'])->name('admin.projects.images.upload');
    Route::delete('/projects/{id}/images/{imageId}', [ProjectAdminController::class, 'deleteImage'])->name('admin.projects.images.delete');
    Route::put('/projects/{id}/set-cover', [ProjectAdminController::class, 'setCover'])->name('admin.projects.setCover');
});

// Профиль пользователя
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Auth (логин, регистрация)
require __DIR__.'/auth.php';

// API маршруты
Route::middleware('api')->prefix('api')->group(function () {
    Route::get('/test', TestController::class);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/translations', function (Request $request) {
        $locale = App::getLocale(); // Получаем текущий язык
        Log::info("Текущий язык: " . $locale); // ✅ Проверяем в логах
        return response()->json([
            'home' => Lang::get('home', [], $locale),
            'header' => Lang::get('header', [], $locale),
            'about' => Lang::get('about', [], $locale),
            'contact' => Lang::get('contact', [], $locale),
        ]);
    });
    Route::post('/contact/send', [ContactController::class, 'send']);
});

// Этот маршрут ДОЛЖЕН быть последним
Route::get('/{any}', function () {
    return Inertia::render('App'); // Твой основной Vue компонент
})->where('any', '.*');


