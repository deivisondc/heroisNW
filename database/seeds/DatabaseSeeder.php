<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        $this->call([
        	ClasseSeeder::class,
        	EspecialidadeSeeder::class,
        	PersonagemSeeder::class,
        	RaidSeeder::class,
            EspecialidadePersonagemSeeder::class,
            PersonagemRaidSeeder::class,
            UserSeeder::class
        ]);
    }
}
