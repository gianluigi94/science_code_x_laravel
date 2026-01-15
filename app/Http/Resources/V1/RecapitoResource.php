<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecapitoResource extends JsonResource
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
            'id_recapito' => $this->id_recapito,
            'id_contatto' => $this->id_contatto,
            'id_tipo_recapito' => $this->id_tipo_recapito,
            'recapito' => $this->recapito,
        ];
    }
}
