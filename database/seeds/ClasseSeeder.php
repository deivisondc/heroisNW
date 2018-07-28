<?php

use Illuminate\Database\Seeder;
use heroisNW\Classe;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classe::create(['id' => 1, 'nome' => 'Mago']);
        Classe::create(['id' => 2, 'nome' => 'Sacerdote']);
        Classe::create(['id' => 3, 'nome' => 'Lutador']);
        Classe::create(['id' => 4, 'nome' => 'Arqueiro']);
        Classe::create(['id' => 5, 'nome' => 'Cavaleiro']);
        Classe::create(['id' => 6, 'nome' => 'Espadachim']);
    }
}
