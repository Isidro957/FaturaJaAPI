<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Empresa;

class ApplyTenant
{
    public function handle($request, Closure $next)
    {
        $decoded = $request->get('user_auth0');

        if (!$decoded || !isset($decoded['tenant_id'])) {
            return response()->json(['message' => 'Tenant não encontrado no token'], 403);
        }

        $empresa = Empresa::where('tenant_id', $decoded['tenant_id'])->first();

        if (!$empresa) {
            return response()->json(['message' => 'Empresa associada ao tenant não existe'], 403);
        }

        // Salvar no request (visível para todos os controllers)
        $request->merge([
            'empresa_id' => $empresa->id,
            'tenant_id'  => $empresa->tenant_id,
        ]);

        return $next($request);
    }
}
