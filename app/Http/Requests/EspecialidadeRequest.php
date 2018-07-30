<?php

namespace heroisNW\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadeRequest extends FormRequest
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
            'nome' => 'required|min:3|max:50'
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'O campo \'Nome\' é obrigatório.',
            'nome.min' => 'O campo \'Nome\' deve conter no mínimo :min caracteres.',
            'nome.max' => 'O campo \'Nome\' deve conter no máximo :max caracteres.'
        ];
    }
}
