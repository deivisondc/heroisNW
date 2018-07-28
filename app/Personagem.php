<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    
    protected $table = 'personagens';
	protected $fillable = ['nome', 'pontos_vida', 'pontos_defesa', 'pontos_dano', 'velocidade_ataque', 'velocidade_movimento', 'classe_id'];

	public $timestamps = false;

	public function classe() {
		return $this->belongsTo('heroisNW\Classe');
	}

	public function especialidades() {
		return $this->belongsToMany('heroisNW\Especialidades', 'especialidades_personagens');
	}

	public function raids() {
		return $this->belongsToMany('heroisNW\Raid', 'personagens_raids');
	}

}
