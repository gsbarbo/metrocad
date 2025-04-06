<?php

use App\Http\Middleware\MemberCheckMiddleware;
use App\Http\Middleware\ownerCheckMiddleware;
use App\Http\Middleware\userDiscordAutoRoleCheckMiddleware;
use App\Http\Middleware\userDiscordSuspendedRoleCheckMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/');
        $middleware->appendToGroup('web', [
            userDiscordAutoRoleCheckMiddleware::class,
            userDiscordSuspendedRoleCheckMiddleware::class,
            ownerCheckMiddleware::class,
        ]);

        $middleware->alias([
            'MemberCheck' => MemberCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
