<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\StreamingFileResource;
use App\Models\StreamingFileModel;
use Illuminate\Support\Facades\Gate;

class StreamingFileController extends Controller
{
    /**
     * Lista tutti i file di streaming (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = StreamingFileModel::all();
            return new CollectionEstesa($risorsa, StreamingFileResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }



    /**
     * Mostra un singolo file di streaming (solo "visualizzare_media").
     *
     * @param StreamingFileModel $streamingfile
     * @return StreamingFileResource
     */
    public function show(StreamingFileModel $streamingfile)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new StreamingFileResource($streamingfile);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
