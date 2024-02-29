<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecapitoStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
            'idUtente' => 'integer|required',
            'idTipoRecapito' => 'integer|nullable',
            'recapito' => 'integer|nullable'
        ];
    }
}
