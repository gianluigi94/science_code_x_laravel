<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndirizzoResource extends JsonResource
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
            'id_indirizzo'=> $this->id_indirizzo,
            'id_contatto'=> $this->id_contatto,
            'id_tipo_indirizzo' => $this->id_tipo_indirizzo,
            'id_nazione'=> $this-> id_nazione,
            'id_comune'=> $this-> id_comune,
            'cap'=> $this-> cap,
            'indirizzo'=> $this-> indirizzo,
            'civico'=> $this-> civico,
        ];
    }
}
