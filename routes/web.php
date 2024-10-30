<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return response()->json([
        'message' => 'Welcome to the API!',
        ]);
});
