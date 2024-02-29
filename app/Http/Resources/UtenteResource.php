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
        

        $ruolo = Ruolo::find($this->idRuolo);
        $nomeRuolo = $ruolo->nome;
        $stato = Stato::find($this->idStato);
        $nomeStato = $stato->nome;
        $nazione = Nazione::find($this->idNazione);
        $nomeNazione = $nazione->nome;
        $comune = ComuneItaliano::find($this->idNazione);
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
