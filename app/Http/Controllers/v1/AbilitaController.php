<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AbilitaResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\AbilitaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AbilitaController extends Controller
{
    /**
     * Restituisce l'elenco completo delle abilità.
     *
     * Accesso consentito solo a chi possiede l'abilità "sistemista"
     * (verifica tramite Gate::allows('abilita', 'sistemista')).
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'sistemista')) {
            $risorsa = AbilitaModel::all();
            return new CollectionEstesa($risorsa, AbilitaResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
    }



    /**
     * Restituisce il dettaglio di una singola abilità.
     *
     * Accesso consentito solo a chi possiede l'abilità "sistemista".
     *
     * @param AbilitaModel $abilita
     * @return AbilitaResource
     */
    public function show(AbilitaModel $abilita)
    {
        if (Gate::allows('abilita', 'sistemista')) {
            return new AbilitaResource($abilita);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
    }


}
