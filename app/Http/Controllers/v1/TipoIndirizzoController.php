<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\TipoIndirizzoResource;
use App\Models\TipoIndirizzoModel;
use Illuminate\Http\Request;

class TipoIndirizzoController extends Controller
{
    /**
     * Lista tutti i tipi di indirizzo .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        $risorsa = TipoIndirizzoModel::all();
        return new CollectionEstesa($risorsa, TipoIndirizzoResource::class);
    }



    /**
     * Mostra un singolo tipo di indirizzo .
     *
     * @param Request $request
     * @param TipoIndirizzoModel $tipoindirizzo
     * @return TipoIndirizzoResource
     */
    public function show(Request $request, TipoIndirizzoModel $tipoindirizzo)
    {


        $risorsa = new TipoIndirizzoResource($tipoindirizzo);
        return $risorsa;
    }
}
