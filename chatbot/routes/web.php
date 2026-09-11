<?php

use App\Http\Controllers\front\ChatController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function () {
    // **HOME** - Public
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // **LOGIN/REGISTER** - Guest Only
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    // **CHAT** - فقط کاربران لاگین
    Route::middleware('auth')->group(function () {
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
        Route::get('/chat/filter/{category}', [ChatController::class, 'filter'])
            ->name('front.chat.filter')
            ->middleware('auth');

    });
});

// **LOGOUT**
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');
