<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreamingFileResource extends JsonResource
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
            'id_streaming_file' => $this->id_streaming_file,
            'descrizione' => $this->descrizione,
            'url_auto' => $this->url_auto,
            'url_1080' => $this->url_1080,
            'url_720' => $this->url_720,
            'url_360' => $this->url_360,

        ];
    }
}
