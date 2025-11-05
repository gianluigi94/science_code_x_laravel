<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TraduzioneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi()
    {
        return [
            'id_traduzione' => $this->id_traduzione,
            'chiave' => $this->chiave,
            'id_lingua' => $this->id_lingua,
            'valore' => $this->valore,
        ];
    }
}
