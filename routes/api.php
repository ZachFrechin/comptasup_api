<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

//TODO: Ajouter le middleware pour autoriser l'endpoint uniquement aux admins.
Route::post('/register', [AuthController::class, 'register']);
