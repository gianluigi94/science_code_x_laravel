<?php
// app/Http/Resources/V1/TassoCambioResource.php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TassoCambioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi()
    {
        return [
            'id_tasso_cambio' => $this->id_tasso_cambio,
            'id_valuta' => $this->id_valuta,
            'tasso' => $this->tasso,
        ];
    }
}
