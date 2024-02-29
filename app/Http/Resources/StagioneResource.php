<?php

namespace App\Http\Resources;

use App\Models\Stagione;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StagioneResource extends JsonResource
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
            'Nome' => $this->nome,
        ];
    }
}
