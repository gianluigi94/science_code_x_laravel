<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndirizzoResource extends JsonResource
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
            'id_indirizzo' => $this->id_indirizzo,
            'id_contatto' => $this->id_contatto,
            'id_tipo_indirizzo' => $this->id_tipo_indirizzo,
            'id_nazione' => $this->id_nazione,
            'id_comune' => $this->id_comune,
            'cap' => $this->cap,
            'indirizzo' => $this->indirizzo,
            'civico' => $this->civico,
        ];
    }
}
