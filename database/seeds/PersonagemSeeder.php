<?php

use Illuminate\Database\Seeder;
use heroisNW\Personagem;

class PersonagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personagem::create([
        	'id' => 1,
            'nome' => 'Steven',
        	'pontos_vida' => 2900,
        	'pontos_defesa' => 200,
        	'pontos_dano' => 340,
        	'velocidade_ataque' => 1.3,
        	'velocidade_movimento' => 320,
        	'classe_id' => 1
        ]);
        Personagem::create([
        	'id' => 2,
            'nome' => 'Mona',
        	'pontos_vida' => 3100,
        	'pontos_defesa' => 200,
        	'pontos_dano' => 180,
        	'velocidade_ataque' => 1.3,
        	'velocidade_movimento' => 330,
        	'classe_id' => 2
        ]);
        Personagem::create([
        	'id' => 3,
            'nome' => 'Morgan',
        	'pontos_vida' => 6000,
        	'pontos_defesa' => 360,
        	'pontos_dano' => 130,
        	'velocidade_ataque' => 1.1,
        	'velocidade_movimento' => 300,
        	'classe_id' => 3
        ]);
        Personagem::create([
        	'id' => 4,
            'nome' => 'Rank',
        	'pontos_vida' => 2500,
        	'pontos_defesa' => 220,
        	'pontos_dano' => 300,
        	'velocidade_ataque' => 1.2,
        	'velocidade_movimento' => 330,
        	'classe_id' => 1
        ]);
        Personagem::create([
        	'id' => 5,
            'nome' => 'Braian',
        	'pontos_vida' => 2400,
        	'pontos_defesa' => 190,
        	'pontos_dano' => 330,
        	'velocidade_ataque' => 1.8,
        	'velocidade_movimento' => 320,
        	'classe_id' => 4
        ]);
        Personagem::create([
        	'id' => 6,
            'nome' => 'Lariel',
        	'pontos_vida' => 3800,
        	'pontos_defesa' => 250,
        	'pontos_dano' => 280,
        	'velocidade_ataque' => 1.5,
        	'velocidade_movimento' => 365,
        	'classe_id' => 5
        ]);
        Personagem::create([
        	'id' => 7,
            'nome' => 'Maycon',
        	'pontos_vida' => 3400,
        	'pontos_defesa' => 260,
        	'pontos_dano' => 290,
        	'velocidade_ataque' => 1.4,
        	'velocidade_movimento' => 365,
        	'classe_id' => 5
        ]);
        Personagem::create([
        	'id' => 8,
            'nome' => 'Rock',
        	'pontos_vida' => 5600,
        	'pontos_defesa' => 400,
        	'pontos_dano' => 150,
        	'velocidade_ataque' => 1.0,
        	'velocidade_movimento' => 300,
        	'classe_id' => 3
        ]);
        Personagem::create([
        	'id' => 9,
            'nome' => 'Rakan',
        	'pontos_vida' => 3000,
        	'pontos_defesa' => 250,
        	'pontos_dano' => 400,
        	'velocidade_ataque' => 1.5,
        	'velocidade_movimento' => 325,
        	'classe_id' => 6
        ]);
        Personagem::create([
        	'id' => 10,
            'nome' => 'Gruntar',
        	'pontos_vida' => 3700,
        	'pontos_defesa' => 240,
        	'pontos_dano' => 190,
        	'velocidade_ataque' => 1.4,
        	'velocidade_movimento' => 345,
        	'classe_id' => 5
        ]);
    }
}
