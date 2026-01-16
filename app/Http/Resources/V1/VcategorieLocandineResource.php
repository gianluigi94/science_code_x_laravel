<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VcategorieLocandineResource extends JsonResource
{
    /**
     * Converte la risorsa Abilita in array JSON.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_categoria'  => $this->id_categoria,
            'tipo'          => $this->tipo,
            'id_contenuto'  => $this->id_contenuto,
            'slug'          => $this->slug,
            'lingua'        => $this->lingua,
        ];
    }
}
