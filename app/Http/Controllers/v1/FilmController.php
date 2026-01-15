<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\FilmResource;
use App\Models\FilmModel;
use Illuminate\Support\Facades\Gate;

class FilmController extends Controller
{
    /**
     * Lista tutti i film (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = FilmModel::all();
            return new CollectionEstesa($risorsa, FilmResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }


    /**
     * Mostra un singolo film (solo "visualizzare_media").
     *
     * @param FilmModel $film
     * @return FilmResource
     */
    public function show(FilmModel $film)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new FilmResource($film);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
