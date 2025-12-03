<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\BeforeValidException;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class Auth0JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return response()->json(['error' => 'Token não fornecido.'], 401);
        }

        $token = $matches[1];

        try {
            // 1️⃣ Obter chaves JWKS do cache ou Auth0
            $jwksUrl = "https://" . config('auth0.domain') . "/.well-known/jwks.json";
            $keys = Cache::remember('auth0_jwks', 60 * 60 * 24, function () use ($jwksUrl) {
                $jwksJson = file_get_contents($jwksUrl);
                if (!$jwksJson) {
                    throw new Exception('Não foi possível obter as chaves JWKS do Auth0.');
                }
                return JWK::parseKeySet(json_decode($jwksJson, true));
            });

            // 2️⃣ Decodificar o token
            $decoded = JWT::decode($token, $keys);
            $decodedArray = json_decode(json_encode($decoded), true);

            // 3️⃣ Validar audience e issuer
            if (($decodedArray['aud'] ?? null) !== config('auth0.client_id')) {
                throw new Exception('Audience inválido.');
            }

            if (($decodedArray['iss'] ?? null) !== 'https://' . config('auth0.domain') . '/') {
                throw new Exception('Issuer inválido.');
            }

            // 4️⃣ Criar ou atualizar usuário no banco
            $empresaId = $decodedArray['empresa_id'] ?? app('empresaAtual')->id ?? null;
            $user = User::updateOrCreateAuth0User($decodedArray, $empresaId);

            // 5️⃣ Anexar usuário no request
            $request->merge([
                'user_auth0' => $decodedArray,
                'user'       => $user,
            ]);

        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Token expirado.'], 401);
        } catch (BeforeValidException $e) {
            return response()->json(['error' => 'Token inválido (antes da validade).'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Token inválido: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
