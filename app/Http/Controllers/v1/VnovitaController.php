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
     * Lista le novità .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        // qui puoi cambiare l'ordine come preferisci
        $risorsa = VnovitaModel::orderBy('descrizione')->get();

        return new CollectionEstesa($risorsa, VnovitaResource::class);
    }

    /**
     * Mostra la novità in posizione $indice (partendo da 1) ordinata per descrizione .
     *
     * @param Request $request
     * @param int $indice
     * @return VnovitaResource
     */
    public function show(Request $request, int $indice)
    {

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
