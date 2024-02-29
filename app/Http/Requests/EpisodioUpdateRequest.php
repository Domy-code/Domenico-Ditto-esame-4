<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodioUpdateRequest extends FormRequest
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
            'idSerieTv' => 'integer',
            'titolo'=>'string|nullable',
            'descrizione' => 'string|nullable',
            'idStagione' => 'integer|nullable',
            'numeroEpisodio' => 'integer|nullable',
            'durata' => 'integer|nullable',
            'anno' => 'integer|nullable',
            'idImmagine' => 'integer|nullable',
            'idFilmato'  =>'integer|nullable' 
        ];
    }
}
