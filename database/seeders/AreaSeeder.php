<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Areas;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author= Areas::create([
            'org_id'  => '1',
            'name_area' => 'Secretaria Geral',
            'slogan_area' => 'SG',
            'telefone_area' => '941492785',
            'email_area' => 'secretariageral@gmail.com',
            'descricao_area' => 'Secretaria geral',
        ]);
    }
}
