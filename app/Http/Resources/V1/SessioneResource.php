<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessioneResource extends JsonResource
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
            'id_sessione' => $this->id_sessione,
            'id_contatto' => $this->id_contatto,
            'token' => $this->token,
            'inizio_sessione' => $this->inizio_sessione,
            'inizio_token' => $this->inizio_token,

        ];
    }
}
