<?php

namespace App\Http\Resources;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SerieTvCollection extends ResourceCollection
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
            'Nome'=>$item['Nome'],
            'Descrizione'=>$item['Descrizione'],
            'Categoria'=>$item['Categoria'],
            'Numero Stagioni'=>$item['Totale Stagioni'],
            'Numero Episodi'=>$item['Numero Episodi'],
            'Regista'=>$item['Regista'],
            'Attori'=>$item['Attori'],
            'Anno Inizio'=>$item['Anno Inizio'],
            'Anno Fine'=>$item['Anno Fine'],
            'Immagine'=>$item['Immagine'],
            'Filmato'=>$item['Filmato'],
    ];
    }
}
