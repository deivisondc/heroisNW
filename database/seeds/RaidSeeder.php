<?php

use Illuminate\Database\Seeder;
use heroisNW\Raid;

class RaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Raid::create([
        	'id' => 1,
        	'descricao' => 'Raid NW'
        ]);
    }
}
