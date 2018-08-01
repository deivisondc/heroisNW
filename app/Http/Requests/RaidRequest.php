<?php

namespace heroisNW\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RaidRequest extends FormRequest
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
        return [
            'descricao' => 'required|min:3|max:200',
            'personagem_array' => 'required'
        ];
    }

    public function messages() {
        return [
            'descricao.required' => 'O campo \'Descrição\' é obrigatório.',
            'descricao.min' => 'O campo \'Descrição\' deve conter no mínimo :min caracteres.',
            'descricao.max' => 'O campo \'Descrição\' deve conter no máximo :max caracteres.',

            'personagem_array.required' => 'É obrigatório selecionar pelo menos um \'Personagem\'.'
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
