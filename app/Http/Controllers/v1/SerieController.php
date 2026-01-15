<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\SerieResource;
use App\Models\SerieModel;
use Illuminate\Support\Facades\Gate;

class SerieController extends Controller
{
    /**
     * Lista tutte le serie (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = SerieModel::all();
            return new CollectionEstesa($risorsa, SerieResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }


    /**
     * Mostra una singola serie (solo "visualizzare_media").
     *
     * @param SerieModel $serie
     * @return SerieResource
     */
    public function show(SerieModel $serie)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new SerieResource($serie);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
