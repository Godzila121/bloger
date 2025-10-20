<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SubscriptionController;

// Головна сторінка
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

// Маршрути для статей
Route::get('/articles', [ArticleController::class, 'index']); // Дублює '/', можна залишити
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth'); // <-- Додано
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth'); // <-- Додано
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');


Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/articles/{article}/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::post('/subscriptions/create-payment', [SubscriptionController::class, 'createPayment'])->name('subscriptions.createPayment');
    Route::get('/subscriptions/success', [SubscriptionController::class, 'success'])->name('subscriptions.success');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/auth.php';
