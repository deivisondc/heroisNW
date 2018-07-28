<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEspecialidadesPersonagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidades_personagens', function(Blueprint $table){
            $table->unsignedInteger('especialidade_id');
            $table->unsignedInteger('personagem_id');

            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->foreign('personagem_id')->references('id')->on('personagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidades_personagens');
    }
}
