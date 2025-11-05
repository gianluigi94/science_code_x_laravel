<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StagioneResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi()
    {
        return [
            'id_stagione'      => $this->id_stagione,
            'id_serie'         => $this->id_serie,
            'descrizione'      => $this->descrizione,
            'numero_stagione'  => $this->numero_stagione,
            'numero_episodi'   => $this->numero_episodi,
        ];
    }
}
