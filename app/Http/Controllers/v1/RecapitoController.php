<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\RecapitoResource;
use App\Models\RecapitoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecapitoController extends Controller
{
    /**
     * Lista tutti i recapiti (solo "moderatore").
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        if (Gate::allows('abilita', 'moderatore')) {
            $risorsa = RecapitoModel::all();
            return new CollectionEstesa($risorsa, RecapitoResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
    }




    /**
     * Mostra un recapito: consentito ad admin principale o al proprietario (richiede "gestire_account").
     *
     * @param RecapitoModel $recapito
     * @return RecapitoResource
     */
    public function show(RecapitoModel $recapito)
    {
        $utenteAutenticato = Auth::user();

        if (Gate::allows('abilita', 'gestire_account')) {
            if (Gate::allows('ruolo', 'amministratore_principale')) {
                return new RecapitoResource($recapito);
            }

            if ($utenteAutenticato->id_contatto === $recapito->id_contatto) {
                return new RecapitoResource($recapito);
            }

            abort(403, "ATTENZIONE: Non hai il permesso di visualizzare questo recapito.");
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (gestire_account).");
    }
}
