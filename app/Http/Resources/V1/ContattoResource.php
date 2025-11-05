<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContattoResource extends JsonResource
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
            'id_contatto' => $this->id_contatto,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'sesso' => $this->sesso,
            'codice_fiscale' => $this->codice_fiscale,
            'data_nascita' => $this->data_nascita,
            'id_stato_utente' => $this->id_stato_utente,
        ];
    }
}
