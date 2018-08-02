<?php

namespace heroisNW\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonagemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if (request()->method() == 'PATCH') {
            return [
                'required_without_all:nome,classe_id,pontos_vida,pontos_defesa,pontos_dano,velocidade_ataque,velocidade_movimento,especialidade_array',
                'nome' => 'min:3|max:50',
                'classe_id' => 'integer',
                'pontos_vida' => 'integer|min:1',
                'pontos_defesa' => 'integer|min:0',
                'pontos_dano' => 'integer|min:1',
                'velocidade_ataque' => 'numeric|min:0.1',
                'velocidade_movimento' => 'integer|min:1',
                'especialidade_array' => 'array'
            ];
        }

        return [
            'nome' => 'required|min:3|max:50',
            'classe_id' => 'required|integer',
            'pontos_vida' => 'required|integer|min:1',
            'pontos_defesa' => 'required|integer|min:0',
            'pontos_dano' => 'required|integer|min:1',
            'velocidade_ataque' => 'required|numeric|min:0.1',
            'velocidade_movimento' => 'required|integer|min:1',
            'especialidade_array' => 'required|array'
        ];
    }

    public function messages() {
        return [
            'required_without_all' => 'É requerido preencher pelo menos um campo.',
            
            'nome.required' => 'O campo \'Nome\' é obrigatório.',
            'nome.min' => 'O campo \'Nome\' deve conter no mínimo :min caracteres.',
            'nome.max' => 'O campo \'Nome\' deve conter no máximo :max caracteres.',

            'classe_id.required' => 'O campo \'Classe\' é obrigatório.',
            'classe_id.integer' => 'O campo \'Classe\' deve ser um número inteiro.',

            'pontos_vida.required' => 'O campo \'Vida\' é obrigatório.',
            'pontos_vida.integer' => 'O campo \'Vida\' deve ser um número inteiro.',
            'pontos_vida.min' => 'O campo \'Vida\' deve ser no mínimo :min.',

            'pontos_defesa.required' => 'O campo \'Defesa\' é obrigatório.',
            'pontos_defesa.integer' => 'O campo \'Defesa\' deve ser um número inteiro.',
            'pontos_defesa.min' => 'O campo \'Defesa\' deve ser no mínimo :min.',

            'pontos_dano.required' => 'O campo \'Dano\' é obrigatório.',
            'pontos_dano.integer' => 'O campo \'Dano\' deve ser um número inteiro.',
            'pontos_dano.min' => 'O campo \'Dano\' deve ser no mínimo :min.',

            'velocidade_ataque.required' => 'O campo \'Velocidade de Ataque\' é obrigatório.',
            'velocidade_ataque.numeric' => 'O campo \'Velocidade de Ataque\' deve ser numérico.',
            'velocidade_ataque.min' => 'O campo \'Velocidade de Ataque\' deve ser no mínimo :min.',

            'velocidade_movimento.required' => 'O campo \'Velocidade de Movimento\' é obrigatório.',
            'velocidade_movimento.integer' => 'O campo \'Velocidade de Movimento\' deve ser um número inteiro.',
            'velocidade_movimento.min' => 'O campo \'Velocidade de Movimento\' deve ser no mínimo :min.',

            'especialidade_array.required' => 'É obrigatório selecionar pelo menos uma \'Especialidade\'.',
            'especialidade_array.array' => 'O campo \'Especialidade\' deve ser um Array.'
        ];
    }

    protected function failedValidation(Validator $validator) {
        if (request()->is('api/*')) {
             throw new HttpResponseException(response()->json(array("validation_error" => $validator->errors()), 422));
        } else {
            parent::failedValidation($validator);
        }
    }
}
