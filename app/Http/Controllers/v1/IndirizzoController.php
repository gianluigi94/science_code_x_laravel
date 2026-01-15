<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\IndirizzoResource;
use App\Models\IndirizzoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IndirizzoController extends Controller
{
    /**
     * Lista tutti gli indirizzi (solo "moderatore").
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        if (Gate::allows('abilita', 'moderatore')) {
            $risorsa = IndirizzoModel::all();
            return new CollectionEstesa($risorsa, IndirizzoResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }


    /**
     * Mostra un indirizzo: consentito ad admin principale o al proprietario (richiede "gestire_account").
     *
     * @param IndirizzoModel $indirizzo
     * @return IndirizzoResource
     */
    public function show(IndirizzoModel $indirizzo)
    {
        $utenteAutenticato = Auth::user();

        if (Gate::allows('abilita', 'gestire_account')) {
            if (Gate::allows('ruolo', 'amministratore_principale')) {
                return new IndirizzoResource($indirizzo);
            }

            if ($utenteAutenticato->id_contatto === $indirizzo->id_contatto) {
                return new IndirizzoResource($indirizzo);
            }

            abort(403, "ATTENZIONE: Non hai il permesso di visualizzare questo indirizzo.");
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (gestire_account).");
    }
}
