<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\Tenant;

class Auth0SyncService
{
    public function sync(array $authUser)
    {
        // ID único do Auth0
        $auth0Id = $authUser['sub'];

        // Buscar usuário na BD
        $user = User::where('auth0_id', $auth0Id)->first();

        // Extrair tenant do Auth0 (secure field)
        $tenantSlug = $authUser['https://faturaja.com/tenant'] ?? null;

        // Buscar tenant correspondente
        $tenant = Tenant::where('slug', $tenantSlug)->first();

        // Criar tenant automaticamente se não existir
        if (!$tenant && $tenantSlug) {
            $tenant = Tenant::create([
                'name' => ucfirst($tenantSlug),
                'slug' => $tenantSlug
            ]);
        }

        // Criar usuário se não existir
        if (!$user) {
            $user = User::create([
                'nome' => $authUser['name'] ?? 'Sem Nome',
                'email' => $authUser['email'],
                'auth0_id' => $auth0Id,
                'tenant_id' => $tenant?->id,
                'profile_photo_path' => $authUser['picture'] ?? null,
                'password' => bcrypt('auth0_user_no_password')
            ]);
        } 
        else {
            // Atualizar dados
            $user->update([
                'nome' => $authUser['name'] ?? $user->nome,
                'email' => $authUser['email'] ?? $user->email,
                'tenant_id' => $tenant?->id,
                'profile_photo_path' => $authUser['picture'] ?? $user->profile_photo_path,
            ]);
        }

        // -------------------------
        // SINCRONIZAR ROLES
        // -------------------------
        $rolesFromAuth0 = $authUser['https://faturaja.com/roles'] ?? [];

        $roleIds = [];

        foreach ($rolesFromAuth0 as $roleName) {

            // Buscar role localmente
            $role = Role::firstOrCreate(['name' => $roleName]);

            $roleIds[] = $role->id;
        }

        // Vincular roles ao usuário (many-to-many)
        $user->roles()->sync($roleIds);

        return $user;
    }
}
