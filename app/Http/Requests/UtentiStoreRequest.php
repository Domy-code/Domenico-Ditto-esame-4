<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UtentiStoreRequest extends FormRequest
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
            'idUtente' => 'nullable|integer',
            'nome' => 'required|string|max:30',
            'cognome'=>'required|string|max:30',
            'email' => 'required|email|max:255|unique:utenti,email',
            'idRuolo'=>'integer',
            'sesso' => 'nullable|integer',
            'codiceFiscale'=>'nullable|string',
            'cittadinanza'=>'nullable|string|max:45',
            'idNazione'=>'nullable|integer',
            'cittaNascita'=>'nullable|string|max:45',
            'idComune'=>'nullable|integer',
            'psw' => 'required|max:30',
            "idTipoIndirizzo"=>'integer|nullable',
            "cap"=>'string|nullable',
            "indirizzo"=>'string|nullable',
            "civico"=>'string|nullable',
            "località"=>'string|nullable'
        ];
    }
}
