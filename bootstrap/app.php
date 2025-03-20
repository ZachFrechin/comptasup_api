<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Barryvdh\DomPDF\ServiceProvider;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: [
            __DIR__.'/../routes/api/api.php',
            __DIR__.'/../routes/api/depense.php',
            __DIR__.'/../routes/api/nature.php',
            __DIR__.'/../routes/api/note.php',
            __DIR__.'/../routes/api/noteHistory.php',
            __DIR__.'/../routes/api/role.php',
            __DIR__.'/../routes/api/service.php',
            __DIR__.'/../routes/api/user.php',
            __DIR__.'/../routes/api/mail.php'
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })
    ->withProviders([
        ServiceProvider::class,
    ])
    ->create();
