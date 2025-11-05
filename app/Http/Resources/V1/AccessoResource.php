<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessoResource extends JsonResource
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
            'id_accesso' => $this->id_accesso,
            'id_contatto' => $this->id_contatto,
            'indirizzo_ip' => $this->indirizzo_ip,
            'successo' => (bool)$this->successo,

        ];
    }




}
