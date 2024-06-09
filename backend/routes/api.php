<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;



Route::middleware('guest')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function (){
    Route::resource('posts', PostController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
