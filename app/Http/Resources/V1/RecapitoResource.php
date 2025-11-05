<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecapitoResource extends JsonResource
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
            'id_recapito' => $this->id_recapito,
            'id_contatto' => $this->id_contatto,
            'id_tipo_recapito' => $this->id_tipo_recapito,
            'recapito' => $this->recapito,
        ];
    }
}
