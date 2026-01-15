<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\TassoCambioResource;
use App\Models\TassoCambioModel;
use Illuminate\Http\Request;

class TassoCambioController extends Controller
{
    /**
     * Lista tutti i tassi di cambio .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = TassoCambioModel::all();
        return new CollectionEstesa($risorsa, TassoCambioResource::class);
    }

    /**
     * Mostra un singolo tasso di cambio .
     *
     * @param Request $request
     * @param TassoCambioModel $tassocambio
     * @return TassoCambioResource
     */
    public function show(Request $request, TassoCambioModel $tassocambio)
    {
        $risorsa = new TassoCambioResource($tassocambio);
        return $risorsa;
    }
}
