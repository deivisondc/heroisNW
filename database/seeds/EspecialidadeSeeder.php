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
        Especialidade::create(['nome' => 'Magia Branca']);
        Especialidade::create(['nome' => 'Cura']);
        Especialidade::create(['nome' => 'Tanker']);
        Especialidade::create(['nome' => 'Invocação']);
        Especialidade::create(['nome' => 'Ataque à Distância']);
        Especialidade::create(['nome' => 'Matador de Chefes']);
        Especialidade::create(['nome' => 'Antitanque']);
        Especialidade::create(['nome' => 'Ataque em Área']);
    }
}
