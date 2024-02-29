<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoIndirizzoResource extends JsonResource
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
        return [
            'idTipoIndirizzo' => $this->idTipoIndirizzo,
            'nome' => $this->nome
        ];
    }
}
