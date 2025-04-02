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

use Barryvdh\DomPDF\ServiceProvider;

Route::get('/check-dompdf', function () {
    return class_exists(ServiceProvider::class) ? 'DomPDF est chargé' : 'DomPDF introuvable';
});

