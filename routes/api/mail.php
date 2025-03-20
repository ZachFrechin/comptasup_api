<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;


Route::get(uri: '/mail', action: [MailController::class, 'index']);
