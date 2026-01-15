<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\TipoRecapitoResource;
use App\Models\TipoRecapitoModel;
use Illuminate\Http\Request;

class TipoRecapitoController extends Controller
{
    /**
     * Lista tutti i tipi recapito .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = TipoRecapitoModel::all();
        return new CollectionEstesa($risorsa, TipoRecapitoResource::class);
    }


    /**
     * Mostra un singolo tipo recapito .
     *
     * @param Request $request
     * @param TipoRecapitoModel $tipo
     * @return TipoRecapitoResource
     */
    public function show(Request $request, TipoRecapitoModel $tipo)
    {
        $risorsa = new TipoRecapitoResource($tipo);
        return $risorsa;
    }
}
