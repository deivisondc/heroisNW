<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    
	protected $fillable = ['nome'];

	public $timestamps = false;

	public function personagens() {
		return $this->belongsToMany('heroisNW\Personagem', 'especialidades_personagens');
	}

}
