<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Raid extends Model
{
    
	protected $fillable = ['descricao'];

	public $timestamps = false;

	public function personagens() {
		return $this->belongsToMany('heroisNW\Personagem', 'personagens_raids');
	}

}
