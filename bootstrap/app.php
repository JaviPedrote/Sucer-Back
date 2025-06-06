<?php

use App\Http\Middleware\AnnouncementApiMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

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
    $middleware->append([
        HandleCors::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
