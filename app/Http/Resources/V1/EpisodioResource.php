<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodioResource extends JsonResource
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
            'id_episodio'      => $this->id_episodio,
            'id_serie'         => $this->id_serie,
            'descrizione'      => $this->descrizione,
            'id_stagione'      => $this->id_stagione,
            'numero_episodio'  => $this->numero_episodio,
            'durata'           => $this->durata,
            'img_anteprima'    => $this->img_anteprima,
            'id_streaming_file'=> $this->id_streaming_file,
        ];
    }
}
