<?php

use App\Http\Controllers\Plans\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'unSubscribed'])->get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    'subscribed',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('product'))->name('dashboard');
});

Route::middleware(['auth:sanctum', 'subscribed'])->get('product', fn () => view('product'))->name('product');

Route::name('plans.')->prefix('plans')->group(function () {
    Route::get('/', IndexController::class)->name('index');
});

Route::name('subscriptions.')->prefix('subscriptions')->group(function () {
    Route::middleware(['signed'])->get('/success', fn () => view('subscriptions.success'))->name('success');

    Route::middleware(['subscribed'])->group(function () {
        Route::get('/', \App\Http\Controllers\Subscriptions\IndexController::class)->name('index');

        Route::name('receipts.')->prefix('receipts')->group(function () {
            Route::get('/', \App\Http\Controllers\Subscriptions\Receipts\IndexController::class)->name('index');
        });
    });
});
