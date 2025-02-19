<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post(uri: '/login', action: [AuthController::class, 'login']);
