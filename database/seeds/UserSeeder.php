<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'id' => 1,
        	'name' => 'Teste',
        	'email' => 'teste@teste.com.br',
        	'password' => '$2y$10$77gLcaHnMuDljttoDPTImuP1K9mMXA.XfyPU5Dvoc1SomYcrPd8lS'
        ]);
    }
}
