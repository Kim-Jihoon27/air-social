<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\AirSocialController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AirSocialController::class, 'index'])->name('home');
Route::get('/newsfeed', [AirSocialController::class, 'newsfeed'])->name('newsfeed');
Route::post('/newsfeed', [AirSocialController::class, 'store'])->name('newsfeed.store');
Route::post('/ai/improve', [AIController::class, 'improveWriting'])->name('ai.improve');

Route::middleware('web')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/post/{post}', [AirSocialController::class, 'update'])->name('post.update')->middleware('auth');
    Route::delete('/post/{post}', [AirSocialController::class, 'destroy'])->name('post.destroy')->middleware('auth');
});
