<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Auth0WebMiddleware;
use App\Http\Middleware\Auth0JwtMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Alias dos middlewares
        $middleware->alias([
            // Grupo web completo (sessão, cookies, CSRF)
            'web' => [
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],

            // Autenticação
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

            // Auth0
            'auth0.web' => Auth0WebMiddleware::class,
            'auth0.jwt' => Auth0JwtMiddleware::class,

            // Roles
            'role' => \App\Http\Middleware\CheckRole::class,
            'tenant' => \App\Http\Middleware\ApplyTenant::class,
        ]);

        // Middlewares globais
        $middleware->prepend(\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class);
        $middleware->prepend(\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class);
        $middleware->prepend(\Illuminate\Foundation\Http\Middleware\TrimStrings::class);
        $middleware->prepend(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
