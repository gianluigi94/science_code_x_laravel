<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\LinguaResource;
use App\Models\LinguaModel;
use Illuminate\Http\Request;

class LinguaController extends Controller
{
    /**
     * Lista tutte le lingue .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        $risorsa = LinguaModel::all();
        return new CollectionEstesa($risorsa, LinguaResource::class);
    }



    /**
     * Mostra una singola lingua .
     *
     * @param Request $request
     * @param LinguaModel $lingua
     * @return LinguaResource
     */
    public function show(Request $request, LinguaModel $lingua)
    {
        $risorsa = new LinguaResource($lingua);
        return $risorsa;
    }
}
