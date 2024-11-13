<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/doc', function () {
    return response()->json([
        'message' => 'Welcome to the API!',
        ]);
});
