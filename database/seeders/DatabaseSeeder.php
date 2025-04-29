<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use App\Models\Organizacoes;
use App\Models\Areas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolesSeeder::class);
        $this->call(OrganizacaoSeeder::class);
        $this->call(AreaSeeder::class);
        $rush = Hash::make('12345678');
        $author= User::create([
            'user_id_area' => 1,
            'name' => 'Sdoca',
            'email' => 'sdoca@gmail.com',
            'password' => $rush
        ]);
        $author= Role_User::create([
            'user_id' => 1,
            'role_id' => '1'
        ]);
    }
}
