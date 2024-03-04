<?php

namespace App\Http\Resources;

use App\Models\ComuneItaliano;
use App\Models\Nazione;
use App\Models\Ruolo;
use App\Models\Stato;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UtenteResource extends JsonResource
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
        

        $ruolo = Ruolo::findOrFail($this->idRuolo);
        $nomeRuolo = $ruolo->nome;
        $stato = Stato::findOrFail($this->idStato);
        $nomeStato = $stato->nome;
        $nazione = Nazione::findOrFail($this->idNazione);
        $nomeNazione = $nazione->nome;
        $comune = ComuneItaliano::findOrFail($this->idNazione);
        $nomeComune = $comune->nome;
        return [
            'idUtente'=>$this->idUtente,
            'Ruolo'=>$nomeRuolo,
            'Stato'=>$nomeStato,
            'Nome'=>$this->nome,
            'Cognome'=>$this->cognome,
            'Email'=>$this->email,
            'Sesso'=>$this->sesso,
            'Codice Fiscale'=>$this->codiceFiscale,
            'Cittadinanza'=>$this->cittadinanza,
            'Nazione'=>$nomeNazione,
            'CittaNascita'=>$this->cittaNascita,
            'Comune'=>$this->$nomeComune
        ];
    }
}
