<?php

namespace App\Http\Resources;

use App\Models\ComuneItaliano;
use App\Models\Nazione;
use App\Models\Ruolo;
use App\Models\Stato;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UtenteCollection extends ResourceCollection
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
        $ruolo = Ruolo::findOrFail($item['idRuolo']);
$nomeRuolo = $ruolo->nome;
$stato = Stato::findOrFail($item['idStato']);
$nomeStato = $stato->nome;
$nazione = Nazione::findOrFail($item['idNazione']);
$nomeNazione = $nazione->nome;
$comune = ComuneItaliano::findOrFail($item['idNazione']);
$nomeComune = $comune->nome;
        return [
            'idUtente'=>$item['idUtente'],
            'Ruolo'=>$nomeRuolo,
            'Stato'=>$nomeStato,
            'Nome'=>$item['nome'],
            'Cognome'=>$item['cognome'],
            'Email'=>$item['email'],
            'Sesso'=>$item['sesso'],
            'Codice Fiscale'=>$item['codiceFiscale'],
            'Cittadinanza'=>$item['cittadinanza'],
            'Nazione'=>$nomeNazione,
            'cittaNascita'=>$item['cittaNascita'],
            'Comune'=>$nomeComune, 
    ];
    }
}
