<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        /*
        |----------------------------------------------------------------------
        | Redirecionamento para visitantes não autenticados (rotas web)
        |----------------------------------------------------------------------
        | As views protegidas usam auth-guard.js no frontend para redirecionar.
        | Este handler cobre o caso de rotas API que exigem autenticação via
        | Sanctum — retorna 401 JSON em vez de redirecionar para HTML.
        */
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                abort(401, 'Unauthenticated.');
            }

            return '/login';
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

