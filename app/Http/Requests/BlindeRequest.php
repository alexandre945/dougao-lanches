<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlindeRequest extends FormRequest
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
            'name' =>   ['required'],
            'points' => ['required'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => ['o campo nome é obrigatorío'],
            'points.required' => ['o campo pontos é obrigatorío e dev ser um número'],


        ];
    }
}
