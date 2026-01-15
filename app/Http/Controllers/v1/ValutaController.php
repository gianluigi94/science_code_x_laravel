<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\ValutaResource;
use App\Models\ValutaModel;
use Illuminate\Http\Request;

class ValutaController extends Controller
{
    /**
     * Lista tutte le valute .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = ValutaModel::all();
        return new CollectionEstesa($risorsa, ValutaResource::class);
    }


    /**
     * Mostra una singola valuta .
     *
     * @param Request $request
     * @param ValutaModel $valuta
     * @return ValutaResource
     */
    public function show(Request $request, ValutaModel $valuta)
    {
        $risorsa = new ValutaResource($valuta);
        return $risorsa;
    }
}
