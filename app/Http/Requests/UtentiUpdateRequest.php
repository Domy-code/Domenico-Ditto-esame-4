<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UtentiUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {  
        return [
            'nome' => 'string|max:30|nullable',
            'cognome' => 'string|max:30|nullable',
            'email' => 'nullable|email|unique:utenti,email',
            'sesso' => 'integer|max:2|nullable',
            'codiceFiscale' => 'string|max:16|nullable',
            'cittadinanza' => 'string|nullable',
            'idNazione' => 'integer|nullable',
            'cittaNascita' => 'string|nullable',
            'idComune' => 'integer|nullable',
            'psw' => 'string|nullable'
        ];
    }
}
