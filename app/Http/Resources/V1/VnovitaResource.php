<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VnovitaResource extends JsonResource
{
    /**
     * Converte la risorsa Abilita in array JSON.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'descrizione' => $this->descrizione,
            'titolo'      => $this->titolo,
            'sottotitolo' => $this->sottotitolo,
            'lingua'      => $this->lingua,
        ];
    }
}
