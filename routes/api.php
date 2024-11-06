<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/store', 'store');
        Route::put('/update/{id}', 'update');
        Route::delete('/destroy/{id}', 'destroy');
        Route::put('/updateRole/{id}', 'updateRole');
        Route::delete('/deleteRole/{id}', 'deleteRole');
    });
});

Route::prefix('role')->group(function () {
    Route::controller(RoleController::class)->group(function () {
        Route::get('/','index');
        Route::get('/{id}','show');
        Route::post('/store','store');
        Route::put('/update/{id}','update');
        Route::delete('/destroy/{id}', 'destroy');

    });
});
