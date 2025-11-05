<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class contatto_ruolo
{
    public function handle(Request $request, Closure $next, ...$required_ruoli): Response
    {
        $ruoli_utente = (array)($request->contatti_ruoli ?? []);

        foreach ($ruoli_utente as $ruolo) {
            foreach ($required_ruoli as $pattern) {
                $isRegex = strlen($pattern) > 2 && $pattern[0] === '/' && substr($pattern, -1) === '/';
                if (
                    $ruolo === $pattern ||
                    ($isRegex && preg_match($pattern, $ruolo)) ||
                    Str::is($pattern, $ruolo) // supporta wildcard tipo utente_* / amministratore_*
                ) {
                    return $next($request);
                }
            }
        }

        abort(403, 'ATTENZIONE: non possiedi il ruolo corretto');
    }
}
