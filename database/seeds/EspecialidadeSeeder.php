<?php

use Illuminate\Database\Seeder;
use heroisNW\Especialidade;

class EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidade::create([
            'id' => 1,
            'nome' => 'Magia Branca'
        ]);
        Especialidade::create([
            'id' => 2,
            'nome' => 'Cura'
        ]);
        Especialidade::create([
            'id' => 3,
            'nome' => 'Tanker'
        ]);
        Especialidade::create([
            'id' => 4,
            'nome' => 'Invocação'
        ]);
        Especialidade::create([
            'id' => 5,
            'nome' => 'Ataque à Distância'
        ]);
        Especialidade::create([
            'id' => 6,
            'nome' => 'Matador de Chefes'
        ]);
        Especialidade::create([
            'id' => 7,
            'nome' => 'Antitanque'
        ]);
        Especialidade::create([
            'id' => 8,
            'nome' => 'Ataque em Área'
        ]);
    }
}
