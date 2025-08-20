<?php

use App\Http\Middleware\MemberCheckMiddleware;
use App\Http\Middleware\ownerCheckMiddleware;
use App\Http\Middleware\steamLinkCheckMiddleware;
use App\Http\Middleware\userDiscordAutoRoleCheckMiddleware;
use App\Http\Middleware\userDiscordSuspendedRoleCheckMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
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
            'SteamLinkCheck' => steamLinkCheckMiddleware::class,
            'DiscordDepartmentRoleSync' => \App\Http\Middleware\DiscordDepartmentRoleSyncMiddleware::class,
            'NewOfficerCheck' => \App\Http\Middleware\Workbench\NewOfficerCheckMiddleware::class,
            'ActiveUnitAutoOffDuty' => \App\Http\Middleware\Mdt\ActiveUnitAutoOffDutyMiddleware::class,
            'ActiveUnitCheck' => \App\Http\Middleware\Mdt\ActiveUnitCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
