<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class pontsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'points' => 'required | numeric', // Remova o caractere "|"
            'image'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'points.required' => 'O campo pontos é obrigatório.',
            'points.numeric' => 'Este campo deve ser um número.',
            'image.required' => 'A imagem é obrigatória.'
        ];
    }
}
