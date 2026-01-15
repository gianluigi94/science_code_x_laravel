<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\EpisodioResource;
use App\Models\EpisodioModel;
use Illuminate\Support\Facades\Gate;

class EpisodioController extends Controller
{
    /**
     * Lista tutti gli episodi (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = EpisodioModel::all();
            return new CollectionEstesa($risorsa, EpisodioResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }

    /**
     * Mostra un singolo episodio (solo "visualizzare_media").
     *
     * @param EpisodioModel $episodio
     * @return EpisodioResource
     */
    public function show(EpisodioModel $episodio)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new EpisodioResource($episodio);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
