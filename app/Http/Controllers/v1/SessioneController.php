<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\SessioneResource;
use App\Models\SessioneModel;
use Illuminate\Support\Facades\Gate;

class SessioneController extends Controller
{
    /**
     * Lista tutte le sessioni (solo "moderatore").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'moderatore')) {
            $risorsa = SessioneModel::all();
            return new CollectionEstesa($risorsa, SessioneResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }



    /**
     * Mostra una singola sessione (solo "moderatore").
     *
     * @param SessioneModel $sessione
     * @return SessioneResource
     */
    public function show(SessioneModel $sessione)
    {
        if (Gate::allows('abilita', 'moderatore')) {
            return new SessioneResource($sessione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }
}
