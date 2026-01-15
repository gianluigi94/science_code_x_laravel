<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\EpisodioTraduzioneResource;
use App\Models\EpisodioTraduzioneModel;
use Illuminate\Support\Facades\Gate;

class EpisodioTraduzioneController extends Controller
{
    /**
     * Lista tutte le traduzioni episodi (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = EpisodioTraduzioneModel::all();
            return new CollectionEstesa($risorsa, EpisodioTraduzioneResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }


    /**
     * Mostra una singola traduzione episodio (solo "visualizzare_media").
     *
     * @param EpisodioTraduzioneModel $episodiotraduzione
     * @return EpisodioTraduzioneResource
     */
    public function show(EpisodioTraduzioneModel $episodiotraduzione)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new EpisodioTraduzioneResource($episodiotraduzione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
