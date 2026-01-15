<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieTraduzioneResource extends JsonResource
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
            'id_serie_traduzione' => $this->id_serie_traduzione,
            'id_serie'            => $this->id_serie,
            'id_lingua'           => $this->id_lingua,

            'img_titolo'          => $this->img_titolo,
            'titolo'              => $this->titolo,

            'sottotitolo'         => $this->sottotitolo,
            'trailer'             => $this->trailer,
            'descrizione'         => $this->descrizione,
            'img_locandina'       => $this->img_locandina,
        ];
    }
}
