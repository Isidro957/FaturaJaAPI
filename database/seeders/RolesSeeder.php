<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $author=Role::create([
      'name'  => 'Super Admin',
      'slug' => 'SADM',
      'permission' => json_encode([
      'super-admin-post' =>true,
      'admin-post' =>true,
      'supervi-post' =>true,
      'estagiario-post' =>true,
      'user-post' =>true,
      'create-post' =>true,
      'gci-post' =>true,
      'rh-post' =>true,
      'gti-post' =>true,
      'online-post' =>true,
      'publish-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'Admin',
      'slug' => 'ADM',
      'permission' => json_encode([
      'admin-post' =>true,
      'supervi-post' =>true,
      'estagiario-post' =>true,
      'user-post' =>true,
      'create-post' =>true,
      'gci-post' =>true,
      'rh-post' =>true,
      'gti-post' =>true,
      'online-post' =>true,
      'publish-post' =>true,

      ]),

      ]);

      $author=Role::create([
      'name'  => 'Supervisor',
      'slug' => 'supervisor',
      'permission' => json_encode([
      'supervi-post' =>true,
      'estagiario-post' =>true,
      'user-post' =>true,
      'create-post' =>true,
      'online-post' =>true,
      'publish-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'Estagiário',
      'slug' => 'estagiario',
      'permission' => json_encode([
      'estagiario-post' =>true,
      'user-post' =>true,
      'create-post' =>true,
      'online-post' =>true,
      'publish-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'User',
      'slug' => 'user',
      'permission' => json_encode([
      'user-post' =>true,
      'create-post' =>true,
      'online-post' =>true,
      'publish-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'GTI',
      'slug' => 'gti',
      'permission' => json_encode([
      'create-post' =>true,
      'gti-post' =>true,
      'publish-post' =>true,
      'online-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'GCI',
      'slug' => 'gci',
      'permission' => json_encode([
      'create-post' =>true,
      'gci-post' =>true,
      'publish-post' =>true,
      'online-post' =>true,
      ]),

      ]);

      $author=Role::create([
      'name'  => 'RH',
      'slug' => 'rh',
      'permission' => json_encode([
      'create-post' =>true,
      'rh-post' =>true,
      'publish-post' =>true,
      'online-post' =>true,
      ]),

      ]);

    }
}
