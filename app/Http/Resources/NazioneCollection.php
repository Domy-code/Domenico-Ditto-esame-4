<?php

namespace App\Http\Resources;

use App\Models\Nazione;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NazioneCollection extends ResourceCollection
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
            'Nome'=>$item['nome'],
            'Continente'=>$item['continente'],
            'Iso2'=>$item['iso2'],
            'Iso3'=>$item['iso3'],
            'Attori'=>$item['attori'],
            'Prefisso Telefonico'=>$item['prefissoTelefonico']
    ];
    }
}
