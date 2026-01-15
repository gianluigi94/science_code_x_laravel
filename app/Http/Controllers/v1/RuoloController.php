<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\RuoloResource;
use App\Models\RuoloModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RuoloController extends Controller
{
     /**
     * Lista tutti i contatti (solo per sistemista).
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'sistemista')) {
            $risorsa = RuoloModel::all();
            return new CollectionEstesa($risorsa, RuoloResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
    }



    /**
     * Mostra un singolo ruolo (solo "sistemista").
     *
     * @param RuoloModel $ruolo
     * @return RuoloResource
     */
    public function show(RuoloModel $ruolo)
    {
        if (Gate::allows('abilita', 'sistemista')) {
            return new RuoloResource($ruolo);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
    }
}
