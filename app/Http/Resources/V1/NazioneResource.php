<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NazioneResource extends JsonResource
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
            'id_nazione' => $this->id_nazione,
            'nazione_it' => $this->nazione_it,
            'nazione_en' => $this->nazione_en,
            'continente' => $this->continente,
            'iso' => $this->iso,
            'iso3' => $this->iso3,
            'prefisso_tel' => $this->prefisso_tel,
            'id_valuta' => $this->id_valuta,
        ];
    }

}
