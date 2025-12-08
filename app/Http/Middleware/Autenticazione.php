<?php

namespace App\Http\Middleware;

use App\Http\Controllers\v1\AccediController;
use App\Models\ContattoModel;
use App\Models\SessioneModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class Autenticazione
{
    public function handle(Request $request, Closure $next)
    {

        Log::info('AUTH HEADER', [
        'authorization' => $request->header('Authorization'),
        'all' => $request->headers->all(),
    ]);

        $token = $request->bearerToken();

        if (!$token) {
            abort(403, 'ATTENZIONE: TOKEN NON INSERITO');
        }

        $payload = AccediController::verifica_token($token);

        if ($payload != null) {
            $contatto = ContattoModel::where("id_contatto", $payload->data->id_contatto)->firstOrFail();

            if ($contatto->id_stato_utente == 1) {
                Auth::login($contatto);
                $request->merge(['contatti_ruoli' => $contatto->ruoli->pluck('ruolo')->toArray()]);


                $sessione = SessioneModel::dati_sessione($token);
                if ($sessione && $sessione->resta_collegato) {
                    // solo keep-alive dell'idle, non cancellare né riscrivere righe
                    SessioneModel::aggiorna_sessione($token);
                }

                return $next($request)->header('Authorization', 'Bearer ' . $token);
            } else {
                abort(403, 'ATTENZIONE: non sei un amministratore');
            }
        } else {
            abort(403, 'ATTENZIONE: il payload è vuoto');
        }
    }
}
