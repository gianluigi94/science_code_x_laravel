<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            'id_serie'         => $this->id_serie,
            'descrizione'      => $this->descrizione,
            'id_regista'       => $this->id_regista,
            'anno'             => $this->anno,
            'numero_stagioni'  => $this->numero_stagioni,
            'numero_episodi'   => $this->numero_episodi,
            'img_sfondo'       => $this->img_sfondo,
            'novita'           => (bool) $this->novita,
        ];
    }
}
