<?php

namespace App\Http\Resources;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FilmCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tmp= parent::toArray($request);
        $tmp= array_map(array($this, 'getCampi'),$tmp);
        return $tmp;
    }

    protected function getCampi($item)
    { 

        return [
            'Titolo'=>$item['Titolo'],
            'Descrizione'=>$item['Descrizione'],
            'Durata'=>$item['Durata'],
            'Categoria'=>$item['Categoria'],
            'Regista'=>$item['Regista'],
            'Attori'=>$item['Attori'],
            'Anno'=>$item['Anno'],
            'Immagine'=>$item['Immagine'],
            'Filmato'=>$item['Filmato'],
    ];
    }
} 

