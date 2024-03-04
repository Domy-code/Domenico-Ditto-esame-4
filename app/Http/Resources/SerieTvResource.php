<?php

namespace App\Http\Resources;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieTvResource extends JsonResource
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
            'Nome' => $this->nome,
            'Descrizione' => $this->descrizione,
            'Categoria' => $nomeCategoria, 
            'Totale Stagioni' => $this->totaleStagioni,
            'Numero Episodi' => $this->numeroEpisodi,
            'Regista' => $this->regista,
            'Attori' => $this->attori,
            'Anno Inizio' => $this->annoInizio,
            'Anno Fine' => $this->annoFine,
            'Immagine' => $this->idImmagine,
            'Filmato' => $this->idFilmato
        ];
    }
}
