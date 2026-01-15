<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VTraduzioneEffettivaResource extends JsonResource
{
    /**
     * Converte la risorsa Abilita in array JSON.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi(): array
    {
        return [
            'id_traduzione_effettiva' => $this->id_traduzione_effettiva,
            'chiave' => $this->chiave,
            'id_lingua' => $this->id_lingua,
            'valore' => $this->valore,
            'provenienza_custom' => (bool) ($this->provenienza_custom ?? false),
            'updated_at' => $this->updated_at,
        ];
    }
}
