<?php

namespace App\Http\Resources;

use App\Models\TipoRecapito;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecapitoResource extends JsonResource
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
        $tipoRecapito = TipoRecapito::findOrFail($this->idTipoRecapito);
        $nomeTipoRecapito = $tipoRecapito->nome;
        return [
            'idUtente' => $this->idUtente,
            'Tipo Recapito' => $this->$nomeTipoRecapito,
            'Recapito' => $this->recapito
        ];
    }
}
