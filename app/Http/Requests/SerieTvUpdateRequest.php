<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieTvUpdateRequest extends FormRequest
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
            'idCategoria'=>'integer|nullable',
            'nome' => 'string|max:30|nullable',
            'totaleStagioni' => 'integer|nullable',
            'numeroEpisodi' => 'integer|nullable',
            'regista' => 'string|nullable',
            'attori' => 'string|nullable',
            'annoInizio' => 'integer|nullable',
            'annoFine' => 'integer|nullable',
            'idImmagine' => 'integer|nullable',
            'idFilmato' => 'integer|nullable'
        ];
    }
}
