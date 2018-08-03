<?php

use Illuminate\Database\Seeder;

class PersonagemRaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 1,
        	'raid_id' => 1
        ]);
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 2,
        	'raid_id' => 1
        ]);
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 3,
        	'raid_id' => 1
        ]);
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 4,
        	'raid_id' => 1
        ]);
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 5,
        	'raid_id' => 1
        ]);
        DB::table('personagens_raids')->insert([
        	'personagem_id' => 6,
        	'raid_id' => 1
        ]);
    }
}
