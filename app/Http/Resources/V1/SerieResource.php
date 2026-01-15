<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            'id_serie'         => $this->id_serie,
            'descrizione'      => $this->descrizione,
            'id_regista'       => $this->id_regista,
            'anno'             => $this->anno,
            'numero_stagioni'  => $this->numero_stagioni,
            'numero_episodi'   => $this->numero_episodi,
            'img_sfondo'       => $this->img_sfondo,
            'novita'           => (bool) $this->novita,
            'created_at'        => $this->created_at

        ];
    }
}
