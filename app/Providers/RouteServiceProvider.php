<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Este método é chamado durante o boot da aplicação
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Rotas da API (prefixo /api)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rotas Web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
