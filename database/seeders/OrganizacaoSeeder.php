<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizacoes;

class OrganizacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author= Organizacoes::create([
            'name_org'  => 'Sdoca',
            'nif_org' => 12345678,
            'logo_org' => 'padrao.png',
            'telefone_org' => 923678529,
            'email_org' => 'sdoca@gmail.com',
            'provincia_org' => 'luanda',
            'regime_org' => 'Regime Simplificado',
            'descricao_org' => 'Comércio e Prestação de serviços voltada a TI',
            
            ]);
    }
}
