<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComuneCollection extends ResourceCollection
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
            'Id'=>$item['idComune'],
            'Nome'=>$item['nome'],
            'Regione'=>$item['regione'],
            'Provincia'=>$item['Provincia'],
            'Sigla'=>$item['sigla'],
            'Codice Catastale'=>$item['codiceCatastale'],
            'Cap'=>$item['cap']
    ];
    }
}
