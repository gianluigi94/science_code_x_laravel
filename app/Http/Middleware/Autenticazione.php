<?php

namespace App\Http\Middleware;

use App\Http\Controllers\v1\AccediController;
use App\Models\ContattoModel;
use App\Models\SessioneModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class Autenticazione
{
    /**
     * Controllo del token nella richiesta, verifico l'utente e lascio proseguire solo se autenticato e abilitato.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) // Gestisco l'autenticazione prima di far continuare la richiesta
    {

            // DIAGNOSTICA DB: serve a capire perche' "a volte" usa forge invece di root

        $token = $request->bearerToken(); // Estraggo il token Bearer dall'header Authorization

        if (!$token) { // Controllo che il token sia presente
            abort(403, 'ATTENZIONE: TOKEN NON INSERITO'); // Blocco la richiesta se manca il token
        }

        $payload = AccediController::verifica_token($token); // Verifico token e sessione e ottengo i dati del token

        if ($payload != null) { // Controllo che la verifica abbia restituito un payload valido
            $contatto = ContattoModel::where("id_contatto", $payload->data->id_contatto)->firstOrFail(); // Recupero il contatto associato al token o fallisce

            if ($contatto->id_stato_utente == 1) { // Controllo che il contatto sia nello stato utente consentito(non bannato)
                Auth::login($contatto); // Effettuo il login del contatto nel sistema di autenticazione di Laravel(dico che a i permessi per quella request da qui in poi)
                $request->merge(['contatti_ruoli' => $contatto->ruoli->pluck('ruolo')->toArray()]); // Aggiungo alla request la lista dei ruoli del contatto

                return $next($request)->header('Authorization', 'Bearer ' . $token); // Lascio proseguire la richiesta e rimando il token nell'header (per ora rimando lo stesso token, ma in futuro potrei cambiare le informazioni di ritorno)
            } else { // Gestisco il caso in cui l'utente non sia nello stato richiesto
                abort(403, 'ATTENZIONE: sei stato bannato');
            }
        } else { // Gestisco il caso in cui il payload non esista
            abort(403, 'ATTENZIONE: il payload è vuoto');
        }
    }
}
