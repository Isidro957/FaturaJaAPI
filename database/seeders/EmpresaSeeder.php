<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $author= Empresa::create([
            'nome'  => 'Sdoca',
            'nif' => 12345678,
            'logo' => 'padrao.png',
            'email' => 'sdoca@gmail.com',
            'endereco' => 'Kinaxixi, Luanda',
            'telefone' => 923678529,
            'slug' => 'sdoca'            
            ]);
    }
}
