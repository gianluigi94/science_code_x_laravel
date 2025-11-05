<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodioTraduzioneResource extends JsonResource
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
            'id_episodio_traduzione' => $this->id_episodio_traduzione,
            'id_episodio'            => $this->id_episodio,
            'id_lingua'              => $this->id_lingua,
            'titolo'                 => $this->titolo,
            'descrizione'            => $this->descrizione,
        ];
    }
}
