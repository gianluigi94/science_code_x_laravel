<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
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
            'id_film'           => $this->id_film,
            'descrizione'       => $this->descrizione,
            'id_regista'        => $this->id_regista,
            'anno'              => $this->anno,
            'durata'            => $this->durata,
            'img_sfondo'        => $this->img_sfondo,
            'id_streaming_file' => $this->id_streaming_file,
            'novita'            => (bool) $this->novita,
            'created_at'        => $this->created_at
        ];
    }
}
