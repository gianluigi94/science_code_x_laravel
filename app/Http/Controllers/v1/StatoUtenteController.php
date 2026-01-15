<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\StatoUtenteResource;
use App\Models\StatoUtenteModel;
use Illuminate\Support\Facades\Gate;

class StatoUtenteController extends Controller
{
    /**
     * Lista tutti gli stati utente (solo "moderatore").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'moderatore')) {
            $risorsa = StatoUtenteModel::all();
            return new CollectionEstesa($risorsa, StatoUtenteResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }


    /**
     * Mostra un singolo stato utente (solo "moderatore").
     *
     * @param StatoUtenteModel $statoutente
     * @return StatoUtenteResource
     */
    public function show(StatoUtenteModel $statoutente)
    {
        if (Gate::allows('abilita', 'moderatore')) {
            return new StatoUtenteResource($statoutente);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }
}
