<?php

use App\Http\Controllers\IndemniteKilometriqueController;
use Illuminate\Support\Facades\Route;


Route::prefix('indemnite')->group(function () {
    Route::post(uri: '/', action: [IndemniteKilometriqueController::class, 'store']);
    Route::get(uri: '/', action: [IndemniteKilometriqueController::class, 'index']);
    Route::put(uri: '/', action: [IndemniteKilometriqueController::class, 'update']);
});
