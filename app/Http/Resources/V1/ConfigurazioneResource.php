<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurazioneResource extends JsonResource
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

    /**
     * Definisce i campi da includere nella risposta JSON.
     */
    protected function get_campi()
    {
        return [
            'id_configurazione' => $this->id_configurazione,
            'chiave' => $this->chiave,
            'valore' => $this->valore
        ];
    }

}
