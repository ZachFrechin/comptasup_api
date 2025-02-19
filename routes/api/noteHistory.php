<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteHistoryController;

Route::prefix('noteHistory')->middleware('auth:sanctum')->group(function ()
{
    Route::controller(NoteHistoryController::class)->group(function ()
    {
        Route::get('/{note}', 'getNoteHistory');
    });
});


