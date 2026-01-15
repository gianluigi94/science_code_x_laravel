<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AccessoResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\AccessoModel;
use Illuminate\Support\Facades\Gate;

class AccessoController extends Controller
{
    /**
     * Lista tutti gli accessi (solo "moderatore").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'moderatore')) {
            $risorsa = AccessoModel::all();
            return new CollectionEstesa($risorsa, AccessoResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }




    /**
     * Mostra un singolo accesso (solo "moderatore").
     *
     * @param AccessoModel $accesso
     * @return AccessoResource
     */
    public function show(AccessoModel $accesso)
    {
        if (Gate::allows('abilita', 'moderatore')) {
            return new AccessoResource($accesso);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }
}
