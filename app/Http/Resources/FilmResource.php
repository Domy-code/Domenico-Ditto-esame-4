<?php

namespace App\Http\Resources;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{ 
    
    return $this->getCampi();
}

protected function getCampi()
{ 
    // Ottengo l'istanza della categoria
    $categoria = Categoria::findOrFail($this->idCategoria);
    $nomeCategoria = $categoria->nome;
    return [
        'Titolo' => $this->titolo,
        'Descrizione' => $this->descrizione,
        'Durata' => $this->durata,
        'Categoria' => $nomeCategoria, 
        'Regista' => $this->regista,
        'Attori' => $this->attori,
        'Anno' => $this->anno,
        'Immagine' => $this->idImmagine,
        'Filmato' => $this->idFilmato
    ];
}

}
