<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Empresa;

class ResolveEmpresa
{
    public function handle($request, Closure $next)
    {
        // 1️⃣ Tenta header X-Empresa-Slug
        $slug = $request->header('X-Empresa-Slug');

        // 2️⃣ Se não existir, tenta subdomínio: empresa.example.com
        if (!$slug) {
            $host = $request->getHost();
            $parts = explode('.', $host);
            // Ajusta conforme o teu domínio (ex: example.com = 2 parts)
            if (count($parts) > 2) {
                $slug = strtolower($parts[0]); // normaliza para minúsculas
            }
        }

        // 3️⃣ Se ainda não, tenta rota param (ex: /t/{empresa})
        if (!$slug && $request->route() && $request->route('empresa')) {
            $slug = $request->route('empresa');
        }

        // 4️⃣ Busca a empresa no banco
        if ($slug) {
            $empresa = Empresa::where('slug', $slug)->first();
            if ($empresa) {
                // Disponibiliza a instância globalmente
                app()->instance('empresaAtual', $empresa);
            }
        }

        // Opcional: força tenant obrigatório
        // if (!app('empresaAtual')) {
        //     return response()->json(['message' => 'Empresa não encontrada'], 404);
        // }

        return $next($request);
    }
}
