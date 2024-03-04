<?php

namespace App\Http\Resources;

use App\Models\Utente;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditoResource extends JsonResource
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
    $utente = Utente::findOrFail($this->idUtente);
    $nomeUtente = $utente->nome;
    return [
        'credito' => $this->credito
    ];
}
}