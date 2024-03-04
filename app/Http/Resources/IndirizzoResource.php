<?php

namespace App\Http\Resources;

use App\Models\ComuneItaliano;
use App\Models\Nazione;
use App\Models\TipoIndirizzo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndirizzoResource extends JsonResource
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
    $tipoIndirizzo = TipoIndirizzo::findOrFail($this->idTipoIndirizzo);
    $nomeTipoIndirizzo = $tipoIndirizzo->nome;
    $nazione = Nazione::findOrFail($this->idNazione);
    $nomeNazione = $nazione->nome;
    $comune = ComuneItaliano::findOrFail($this->idComune);
    $nomeComune = $comune->nome;
    return [
        'Tipo Indirizzo' => $nomeTipoIndirizzo,
        'idUtente' => $this->idUtente,
        'Nazione' => $nomeNazione,
        'Comune' => $nomeComune, 
        'cap' => $this->cap,
        'indirizzo' => $this->indirizzo,
        'civico' => $this->civico,
        'localita' => $this->localita,
        'lat' => $this->lat,
        'lng' => $this->lng,
    ];
}
}