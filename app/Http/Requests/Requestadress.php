<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Requestadress extends FormRequest
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
            'city'          => 'required',
            'district'      => 'required',
            'street'        => 'required',
            'number'        => 'required',
            'zipcode'       =>  'nullable',
            'complement'    =>  'nullable|max:40',
            'fhone'          =>  'required'
        ];
    }
    public function messages()
    {
        return [
            'city.required'          => 'O Campo cidade é Obrigatorío',
            'district.required'      => 'O Campo bairro é Obrigatorío',
            'street.required'        => 'O Campo Rua é obrigatoío',
            'number.required'        => 'O Campo número é Obrigatorío',
            'zipcode.required'       => 'O Campo CEP não é Obrigatorío',
            'complement.required'    => 'O Campo complemento não é O brigatorío',
            'complement.max'         => 'esse campo tem limite maximo de 40 caracteres',
            'fhone.required'         => 'O Campo celular é obrigatorio'

        ];
    }

}
