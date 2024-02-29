<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndirizzoStoreRequest extends FormRequest
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
            'idTipoIndirizzo' => 'integer|required',
            'idUtente' => 'integer|required',
            'idNazione' => 'integer|required',
            'idComuneItaliano' => 'integer|required',
            'cap' => 'string|nullable',
            'indirizzo' => 'string|required',
            'civico'=> 'string|nullable',
            'località' => 'string|nullable',
            'lat'  =>'string|nullable' ,
            'lng'  =>'string|nullable' 
        ];
    }
}
