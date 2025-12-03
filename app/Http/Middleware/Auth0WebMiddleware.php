<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth0WebMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('auth_user') || !session()->has('auth0_user')) {
            session()->flush();
            return redirect()->route('login')->withErrors([
                'auth' => 'Por favor, faça login para continuar.'
            ]);
        }

        return $next($request);
    }
}
