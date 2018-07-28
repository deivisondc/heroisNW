<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonagens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagens', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome', 50);
            $table->integer('pontos_vida');
            $table->integer('pontos_defesa');
            $table->integer('pontos_dano');
            $table->double('velocidade_ataque');
            $table->integer('velocidade_movimento');
            $table->unsignedInteger('classe_id');

            $table->foreign('classe_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personagens');
    }
}
