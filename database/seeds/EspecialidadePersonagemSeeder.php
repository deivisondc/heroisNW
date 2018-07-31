<?php

use Illuminate\Database\Seeder;

class EspecialidadePersonagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 1,
        	'personagem_id' => 1
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 1,
        	'personagem_id' => 2
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 2,
        	'personagem_id' => 2
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 3,
        	'personagem_id' => 3
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 4,
        	'personagem_id' => 4
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 5,
        	'personagem_id' => 5
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 6,
        	'personagem_id' => 6
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 7,
        	'personagem_id' => 6
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 6,
        	'personagem_id' => 7
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 3,
        	'personagem_id' => 8
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 7,
        	'personagem_id' => 9
        ]);
        DB::table('especialidades_personagens')->insert([
        	'especialidade_id' => 8,
        	'personagem_id' => 10
        ]);
    }
}
