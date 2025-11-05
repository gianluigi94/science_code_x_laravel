<?php
// app/Http/Resources/V1/ValutaResource.php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValutaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return $this->get_campi();
    }

    protected function get_campi()
    {
        return [
            'id_valuta' => $this->id_valuta,
            'codice_iso' => $this->codice_iso,
            'nome' => $this->nome,
            'simbolo' => $this->simbolo,
            'decimali' => $this->decimali,
        ];
    }
}
