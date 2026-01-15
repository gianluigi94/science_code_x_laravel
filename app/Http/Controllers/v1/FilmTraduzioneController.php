<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\FilmTraduzioneResource;
use App\Models\FilmTraduzioneModel;
use Illuminate\Support\Facades\Gate;

class FilmTraduzioneController extends Controller
{
    /**
     * Lista tutte le traduzioni film (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = FilmTraduzioneModel::all();
            return new CollectionEstesa($risorsa, FilmTraduzioneResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }



    /**
     * Mostra una singola traduzione film (solo "visualizzare_media").
     *
     * @param FilmTraduzioneModel $filmtraduzione
     * @return FilmTraduzioneResource
     */
    public function show(FilmTraduzioneModel $filmtraduzione)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new FilmTraduzioneResource($filmtraduzione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
