<?php

use App\Http\Controllers\OcrController;
use Illuminate\Support\Facades\Route;

Route::prefix('ocr')->group(function () {
    Route::post('process', [OcrController::class, 'process']);
});