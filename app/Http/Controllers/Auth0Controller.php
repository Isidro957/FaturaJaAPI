<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Auth0SyncService;
use App\Models\Tenant;
use GuzzleHttp\Client;

class Auth0Controller extends Controller
{
    /**
     * Exibe a tela de login personalizada
     */
    public function showLoginPage()
    {
        return view('login'); 
    }

    /**
     * Login direto para os providers
     */
    public function loginGoogle(Request $request)
    {
        return $this->redirectToProvider('google-oauth2', $request);
    }

    public function loginGithub(Request $request)
    {
        return $this->redirectToProvider('github', $request);
    }

    public function loginLinkedin(Request $request)
    {
        return $this->redirectToProvider('linkedin', $request);
    }

    /**
     * Redireciona para o provider correto
     */
    public function redirect($provider, Request $request)
    {
        switch ($provider) {
            case 'google':
                return $this->loginGoogle($request);
            case 'github':
                return $this->loginGithub($request);
            case 'linkedin':
                return $this->loginLinkedin($request);
            default:
                abort(404, 'Provider inválido');
        }
    }

    /**
     * Função privada que constrói a URL e redireciona
     */
    private function redirectToProvider($connection, Request $request)
    {
        if ($request->has('slug')) {
            session(['tenant_slug' => $request->slug]);
        }

        $auth0 = config('auth0');

        $authorizeUrl = 'https://' . $auth0['domain'] . '/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id'     => $auth0['client_id'],
            'redirect_uri'  => $auth0['redirect_uri'],
            'scope'         => $auth0['scope'],
            'connection'    => $connection,
        ]);

        return redirect()->to($authorizeUrl);
    }

    /**
     * Callback do Auth0 após login
     */
    public function callback(Request $request)
    {
        $client = new Client();
        $auth0 = config('auth0');

        if (!$request->has('code')) {
            return redirect()->route('login')->withErrors(['auth' => 'Código de autorização não fornecido.']);
        }

        try {
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
                return redirect()->route('login')->withErrors(['auth' => 'Falha ao obter Access Token.']);
            }

            $userResponse = $client->get('https://' . $auth0['domain'] . '/userinfo', [
                'headers' => ['Authorization' => 'Bearer ' . $accessToken],
            ]);

            $authUser = json_decode($userResponse->getBody(), true);

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['auth' => 'Erro Auth0: ' . $e->getMessage()]);
        }

        // Sincroniza usuário e roles com a base local
        $syncService = new Auth0SyncService();
        $dbUser = $syncService->sync($authUser);

        // Salva sessão
        session([
            'auth0_user'  => $authUser,
            'auth0_roles' => $authUser['https://faturaja.com/roles'] ?? [],
            'auth_user'   => $dbUser,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->flush();

        $auth0 = config('auth0');

        $logoutUrl = 'https://' . $auth0['domain'] . '/v2/logout?' . http_build_query([
            'client_id' => $auth0['client_id'],
            'returnTo'  => config('app.url'),
        ]);

        return redirect()->to($logoutUrl);
    }
}
