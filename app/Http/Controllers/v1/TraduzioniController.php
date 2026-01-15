<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TraduzioniController extends Controller
{
    /**
     * Restituisce la mappa {chiave: valore} delle traduzioni per codice lingua.
     *
     * @param string $codiceLingua
     * @return JsonResponse
     */
    public function perLingua(string $codiceLingua): JsonResponse
    {
        // Mappa codici in id_lingua
        $idLingua = match ($codiceLingua) {
            'it' => 1,
            'en' => 2,
            default => 2, // se non riconosciuto → inglese
        };

        // Leggo dalla vista v_traduzioni_effettive
        $righe = DB::table('v_traduzioni_effettive')
            ->where('id_lingua', $idLingua)
            ->select('chiave', 'valore')
            ->get();

        // ngx-translate in angular: { chiave: valore }
        $mappa = [];
        foreach ($righe as $riga) {
            $mappa[$riga->chiave] = $riga->valore;
        }

        return response()->json($mappa);
    }
}
