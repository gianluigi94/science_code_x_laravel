<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComuneResource extends JsonResource
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
            'id_comune' => $this->id_comune,
            'comune' => $this->comune,
            'regione' => $this->regione,
            'sigla_automobilistica' => $this->sigla_automobilistica,
            'codice_belfiore' => $this->codice_belfiore,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'is_capoluogo' => $this->is_capoluogo,
            'cap' => $this->cap,
            'cap_inizio' => $this->cap_inizio,
            'cap_fine' => $this->cap_fine,
            'codice_istat' => $this->codice_istat,

        ];
    }
}
