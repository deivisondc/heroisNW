<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    
	protected $fillable = ['nome'];

	public $timestamps = false;

	public function personagens() {
		$this->hasMany('heroisNW\Personagem');
	}

}
