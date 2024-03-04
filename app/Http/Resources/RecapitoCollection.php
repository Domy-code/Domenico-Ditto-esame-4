<?php

namespace App\Http\Resources;

use App\Models\TipoRecapito;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecapitoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tmp = parent::toArray($request);
        $tmp = array_map(array($this, 'getCampi'), $tmp);
        return $tmp;
    }

    protected function getCampi($item)
    {
        $tipoRecapito = TipoRecapito::findOrFail($item['nome']);
        $nomeTipoRecapito = $tipoRecapito->nome;
        return [
            'idUtente' => $item['idUtente'],
            'Tipo Recapito' => $nomeTipoRecapito,
            'Recapito' => $item['recapito']
        ];
    }
}
