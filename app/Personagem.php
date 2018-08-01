<?php

namespace heroisNW;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{

	protected $hidden = ['classe_id', 'thumbmail', 'pivot'];
    protected $table = 'personagens';
	protected $fillable = ['nome', 'pontos_vida', 'pontos_defesa', 'pontos_dano', 'velocidade_ataque', 'velocidade_movimento', 'classe_id', 'thumbmail'];

	public $timestamps = false;

	public function classe() {
		return $this->belongsTo('heroisNW\Classe');
	}

	public function especialidades() {
		return $this->belongsToMany('heroisNW\Especialidade', 'especialidades_personagens');
	}

	public function raids() {
		return $this->belongsToMany('heroisNW\Raid', 'personagens_raids');
	}

	public function nomeDasEspecialidades() {
		$str = '';

		if ($this->especialidades->count() > 0) {
			foreach ($this->especialidades as $especialidade) {
				if (empty($str)) {
					$str .= $especialidade->nome;
				} else {
					$str .= ', ' . $especialidade->nome;
				}
			}
		} else {
			$str = '-';
		}

		return $str;
	}

	public function resumoDoPersonagem() {
		return ' | Classe: ' . $this->classe->nome . ' | Especialidades: ' . $this->nomeDasEspecialidades();
	}

}
