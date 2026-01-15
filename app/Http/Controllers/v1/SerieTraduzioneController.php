<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\SerieResource;
use App\Http\Resources\V1\SerieTraduzioneResource;
use App\Models\SerieTraduzioneModel;
use Illuminate\Support\Facades\Gate;

class SerieTraduzioneController extends Controller
{
    /**
     * Lista tutte le traduzioni serie (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = SerieTraduzioneModel::all();
            return new CollectionEstesa($risorsa, SerieTraduzioneResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }

    /**
     * Mostra una singola traduzione serie (solo "visualizzare_media").
     *
     * @param SerieTraduzioneModel $serietraduzione
     * @return SerieTraduzioneResource
     */
    public function show(SerieTraduzioneModel $serietraduzione)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new SerieTraduzioneResource($serietraduzione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
