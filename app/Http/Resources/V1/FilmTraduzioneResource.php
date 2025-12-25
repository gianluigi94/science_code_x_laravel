<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmTraduzioneResource extends JsonResource
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
            'id_film_traduzione' => $this->id_film_traduzione,
            'id_film'            => $this->id_film,
            'id_lingua'          => $this->id_lingua,

            // 👇 NOVITÀ: separiamo immagine titolo e testo titolo
            'img_titolo'         => $this->img_titolo,  // path immagine (ex "titolo")
            'titolo'             => $this->titolo,      // testo (dal campo "titolo" del JSON)

            'sottotitolo'        => $this->sottotitolo,
            'trailer'            => $this->trailer,
            'descrizione'        => $this->descrizione,
            'img_locandina'      => $this->img_locandina,
        ];
    }
}
