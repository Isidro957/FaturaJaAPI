<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
  public function handle($request, Closure $next, ...$rolesRequired)
    {
        $userRoles = Session::get('auth0_roles', []);

        // Se não tiver roles, nega o acesso
        if (empty($userRoles)) {
            abort(403, 'Acesso negado');
        }

        // Verifica se o usuário tem pelo menos uma das roles necessárias
        foreach ($rolesRequired as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        return abort(403, 'Acesso negado');
    }
}
