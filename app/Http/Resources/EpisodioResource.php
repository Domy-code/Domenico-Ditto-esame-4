<?php

namespace App\Http\Resources;

use App\Models\SerieTv;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodioResource extends JsonResource
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

    return [
       
        'titolo' => $this->titolo,
        'descrizione' => $this->descrizione,
        'stagione' => $this->idStagione,
        'durata' => $this->durata,
        'numeroEpisodio' => $this->numeroEpisodio,
        'anno' => $this->anno,
        'idImmagine' => $this->idImmagine,
        'idFilmato' => $this->idFilmato
    ];
}
}
