<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\Tenant;

class Auth0SyncService
{
    public function sync(array $authUser)
    {
        $auth0Id = $authUser['sub'];

        $user = User::where('auth0_id', $auth0Id)->first();

        $tenantSlug = $authUser['https://faturaja.com/tenant'] ?? null;
        $tenant = Tenant::firstOrCreate(
            ['slug' => $tenantSlug],
            ['name' => ucfirst($tenantSlug)]
        );

        if (!$user) {
            $user = User::create([
                'nome' => $authUser['name'] ?? 'Sem Nome',
                'email' => $authUser['email'],
                'auth0_id' => $auth0Id,
                'tenant_id' => $tenant->id,
                'profile_photo_path' => $authUser['picture'] ?? null,
                'password' => bcrypt('auth0_user_no_password')
            ]);
        } else {
            $user->update([
                'nome' => $authUser['name'] ?? $user->nome,
                'email' => $authUser['email'] ?? $user->email,
                'tenant_id' => $tenant->id,
                'profile_photo_path' => $authUser['picture'] ?? $user->profile_photo_path,
            ]);
        }

        $rolesFromAuth0 = $authUser['https://faturaja.com/roles'] ?? [];
        $roleIds = [];

        foreach ($rolesFromAuth0 as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $roleIds[] = $role->id;
        }

        $user->roles()->sync($roleIds);

        return $user;
    }
}
