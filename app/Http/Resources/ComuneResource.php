<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComuneResource extends JsonResource
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
            'Id' => $this->idComune,
            'Nome' => $this->nome,
            'Continente' => $this->continente,
            'Iso2' => $this->iso2,
            'Iso3' => $this->iso3,
            'Prefisso Telefonico' => $this->prefissoTelefonico
        ];
    }
    

}
