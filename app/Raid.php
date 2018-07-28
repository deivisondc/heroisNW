<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Raid extends Model
{
    
	protected $fillable = ['nome'];

	public $timestamps = false;

	public function personagens() {
		return $this->belongsToMany('heroisNW\Personagem', 'personagens_raids');
	}

}
