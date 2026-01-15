<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class contatto_ruolo
{
    /**
     * Controllo che l'utente abbia almeno uno dei ruoli richiesti e, se sì, lascio proseguire la richiesta.
     *
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$required_ruoli
     * @return Response
     */
    public function handle(Request $request, Closure $next, ...$required_ruoli): Response // Verifico i ruoli dell'utente rispetto a quelli richiesti dalla rotta
    {
        $ruoli_utente = (array)($request->contatti_ruoli ?? []); // Leggo i ruoli dell'utente dalla request e li trasformo in array

        foreach ($ruoli_utente as $ruolo) { // Scorro tutti i ruoli posseduti dall'utente
            foreach ($required_ruoli as $pattern) { // Scorro tutti i ruoli richiesti dalla rotta
                $isRegex = strlen($pattern) > 2 && $pattern[0] === '/' && substr($pattern, -1) === '/'; // Capisco se il ruolo richiesto è espresso come regex
                if ( // Controllo se il ruolo dell'utente corrisponde al ruolo richiesto
                    $ruolo === $pattern || // Verifico la corrispondenza esatta
                    ($isRegex && preg_match($pattern, $ruolo)) || // Verifico la corrispondenza usando la regex, quando presente
                    Str::is($pattern, $ruolo) // Verifico la corrispondenza usando i wildcard
                ) {
                    return $next($request); // Lascio proseguire la richiesta appena trovo una corrispondenza valida
                }
            }
        }

        abort(403, 'ATTENZIONE: non possiedi il ruolo corretto'); // Blocco la richiesta se nessun ruolo dell'utente corrisponde a quelli richiesti
    }
}
