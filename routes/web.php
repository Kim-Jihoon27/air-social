<?php

use App\Http\Controllers\AirSocialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AirSocialController::class,'index'])->name('home');    
Route::post('/air-post', [AirSocialController::class,'store']);
