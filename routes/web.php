<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SubscriptionController;

// Головна сторінка
Route::get('/', function () {
    return redirect()->route('articles.index');
});

// Маршрути для довідника (статей)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Маршрути, що вимагають аутентифікації користувача
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/articles/{article}/ratings', [RatingController::class, 'store'])->name('ratings.store');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions/create-payment', [App\Http\Controllers\SubscriptionController::class, 'createPayment'])->name('subscriptions.createPayment');
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Вказуємо, що маршрут '/dashboard' повинен відображати view 'dashboard'
    // Цей маршрут доступний лише для аутентифікованих користувачів
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});
// Підключення стандартних маршрутів для аутентифікації (вхід, реєстрація і т.д.)
// Цей рядок важливий для роботи сторінок логіну та реєстрації.
require __DIR__.'/auth.php';
