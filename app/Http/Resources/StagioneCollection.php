<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StagioneCollection extends ResourceCollection
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
            'Nome'=>$item['nome']
    ];
    }
}
