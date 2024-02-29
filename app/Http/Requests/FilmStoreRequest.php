<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
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
            'titolo' => 'string|max:30',
            'descrizione' => 'string|nullable',
            'durata' => 'integer|nullable',
            'idCategoria' => 'integer|nullable',
            'regista' => 'string|max:30|nullable',
            'attori' => 'string|nullable',
            'anno'=> 'integer|nullable',
            'idImmagine' => 'integer|nullable',
            'idFilmato'  =>'integer|nullable' 
        ];
    }
}
