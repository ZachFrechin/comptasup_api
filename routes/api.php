<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/', [AuthController::class,'index']);
        Route::get('/{id}', [AuthController::class,'show']);
        Route::get('/store', [AuthController::class,'store']);
        Route::get('/update/{id}', [AuthController::class,'update']);
        Route::get('/destroy/{id}', [AuthController::class,'destroy']);
    });
});