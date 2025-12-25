<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\VnovitaResource;
use App\Models\VnovitaModel;
use Illuminate\Http\Request;

class VnovitaController extends Controller
{
    /**
     * GET /api/v1/novita
     * Restituisce TUTTE le novità (ordine per descrizione, o come vuoi).
     */
    public function index(Request $request)
    {
        AppHelpers::gestisci_sessione($request);

        // qui puoi cambiare l'ordine come preferisci
        $risorsa = VnovitaModel::orderBy('descrizione')->get();

        return new CollectionEstesa($risorsa, VnovitaResource::class);
    }

    /**
     * GET /api/v1/novita/{indice}
     * Esempi:
     *   /api/v1/novita/1  -> primo elemento
     *   /api/v1/novita/5  -> quinto elemento
     *
     * L'indice è 1-based (1 = primo).
     */
    public function show(Request $request, int $indice)
    {
        AppHelpers::gestisci_sessione($request);

        if ($indice < 1) {
            abort(404);
        }

        $record = VnovitaModel::orderBy('descrizione')
            ->skip($indice - 1)
            ->take(1)
            ->firstOrFail();

        return new VnovitaResource($record);
    }
}
