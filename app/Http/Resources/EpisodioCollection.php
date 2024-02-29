<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EpisodioCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tmp = parent::toArray($request);
        $tmp = array_map(array($this, 'getCampi'), $tmp);
        return $tmp;
    }

    protected function getCampi($item)
    {
    
        return [
            'Numero Episodio' => $item['numeroEpisodio'],
            'Titolo' => $item['titolo'],
            'Descrizione' => $item['descrizione'],
            'Durata' => $item['durata'],
            'Anno' => $item['anno'],
            'Immagine' => $item['idImmagine'],
            'Filmato' => $item['idFilmato'],
        ];
    }
}
