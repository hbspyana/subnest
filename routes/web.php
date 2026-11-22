<?php

use App\Http\Controllers\Userzone\CategoryController;
use App\Http\Controllers\Userzone\DashboardController;
use App\Http\Controllers\Userzone\PaymentController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\Userzone\SubscriptionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
 * Public Website routes
 */
Route::get('/', WelcomeController::class)->name('welcome');

// Todo: add your public routes here

/*
 * Authentication routes
 */
require __DIR__.'/auth.php';


/*
 * Userzone routes
 */
Route::middleware('auth')->group(function () {
    // For the user's dashboard (after login)
    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // Todo: add your Userzone routes here
    Route::resource('categories', CategoryController::class);

    // For the user's profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // For the user's subscriptions management
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::put('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscriptions.update');
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');

    // For the user's payments management
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/subscriptions/{subscription}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/subscriptions/{subscription}/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::patch('/payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });