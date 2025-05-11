<?php

use App\Http\Middleware\AnnouncementApiMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        api: __DIR__.'/../routes/api-v1.php',
        apiPrefix: 'api/v1',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    /* ───── ALIAS ───── */
    $middleware->alias([
        'announcement.api' => AnnouncementApiMiddleware::class,
    ]);

    /* ───── GLOBAL ───── */
    // Opción A: sólo añadir HandleCors al principio
    $middleware->prepend(\Illuminate\Http\Middleware\HandleCors::class);

    // Opción B: redefinir todo el stack global (incluye CORS)
    /*
    $middleware->use([
        \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ]);
    */
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
