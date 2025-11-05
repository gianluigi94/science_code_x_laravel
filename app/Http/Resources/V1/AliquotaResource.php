<?php
// app/Http/Resources/V1/AliquotaResource.php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AliquotaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi()
    {
        return [
            'id_aliquota' => $this->id_aliquota,
            'id_nazione' => $this->id_nazione,
            'aliquota' => $this->aliquota,
        ];
    }
}
