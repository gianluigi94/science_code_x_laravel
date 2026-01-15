<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoriaSerieResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\CategoriaSerieModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriaSerieController extends Controller
{
    /**
     * Lista tutte le categorie serie (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = CategoriaSerieModel::all();
            return new CollectionEstesa($risorsa, CategoriaSerieResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }


    /**
     * Mostra una singola categoria serie (solo "visualizzare_media").
     *
     * @param CategoriaSerieModel $categoriaserie
     * @return CategoriaSerieResource
     */
    public function show(CategoriaSerieModel $categoriaserie)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new CategoriaSerieResource($categoriaserie);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
