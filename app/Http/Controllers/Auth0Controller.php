<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth0SyncService;
use App\Models\Tenant;
use GuzzleHttp\Client;

class Auth0Controller extends Controller
{
    /**
     * Redireciona o usuário para a página de login do Auth0
     */
    public function login(Request $request)
    {
        $slug = $request->input('slug'); // Pode vir do front-end

        // Armazena temporariamente o slug na sessão
        if ($slug) {
            session(['tenant_slug' => $slug]);
        }

        $auth0 = config('auth0');

        // ========================
        // URL de autorização com prompt=login
        // ========================
        $authorizeUrl = 'https://' . $auth0['domain'] . '/authorize' .
            '?response_type=code' .
            '&client_id=' . $auth0['client_id'] .
            '&redirect_uri=' . urlencode($auth0['redirect_uri']) .
            '&scope=' . urlencode($auth0['scope']) .
            '&prompt=login'; // força o login

        return redirect()->to($authorizeUrl);
    }

    /**
     * Callback do Auth0 após login
     */
    public function callback(Request $request)
    {
       

        $client = new Client();
        $auth0 = config('auth0');

        // Verifica se veio código
        if (!$request->has('code')) {
            return redirect()->route('login')->withErrors(['auth' => 'Código de autorização não fornecido.']);
        }

        try {
            // Troca o "code" pelo "access_token"
            $response = $client->post('https://' . $auth0['domain'] . '/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'authorization_code',
                    'client_id'     => $auth0['client_id'],
                    'client_secret' => $auth0['client_secret'],
                    'code'          => $request->code,
                    'redirect_uri'  => $auth0['redirect_uri'],
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $accessToken = $data['access_token'] ?? null;

            if (!$accessToken) {
                return redirect()->route('login')->withErrors(['auth' => 'Falha ao obter access token.']);
            }

            // Buscar perfil do usuário no Auth0
            $userResponse = $client->get('https://' . $auth0['domain'] . '/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $user = json_decode($userResponse->getBody(), true);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->route('login')->withErrors(['auth' => 'Erro no Auth0: ' . $e->getMessage()]);
        }

        // Pega roles do namespace personalizado
        $roles = $user['https://faturaja.com/roles'] ?? [];

        // -----------------------------
        // BUSCAR O TENANT PELO SLUG
        // -----------------------------
        $slug = session('tenant_slug');
        $tenant = Tenant::where('slug', $slug)->first();

        if (!$tenant) {
            return redirect()->route('login')->withErrors(['slug' => 'Tenant não encontrado.']);
        }

        // --------------------------------------------
        // SINCRONIZAR O USUÁRIO COM A BASE DE DADOS
        // --------------------------------------------
        $syncService = new Auth0SyncService();
        $dbUser = $syncService->sync($user, $tenant->id);

        // --------------------------------------------
        // GUARDAR SESSÃO LOCAL
        // --------------------------------------------
        session([
            'auth0_user'  => $user,
            'auth0_roles' => $roles,
            'auth_user'   => $dbUser,
            'tenant'      => $tenant,
        ]);
dd('Chegou ao fim do callback', $user);
        return redirect()->route('dashboard');
        


    }

    /**
     * Logout do usuário
     */
    public function logout()
    {
        session()->flush();

        $auth0 = config('auth0');

        $logoutUrl = 'https://' . $auth0['domain'] . '/v2/logout' .
            '?client_id=' . $auth0['client_id'] .
            '&returnTo=' . urlencode(config('app.url'));

        return redirect()->to($logoutUrl);
    }
}
