<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\ComuneResource;
use App\Models\ComuneModel;
use Illuminate\Http\Request;

class ComuneController extends Controller
{
    /**
     * Lista tutti i comuni .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        $risorsa = ComuneModel::all();
        return new CollectionEstesa($risorsa, ComuneResource::class);
    }



    /**
     * Mostra un singolo comune .
     *
     * @param Request $request
     * @param ComuneModel $comune
     * @return ComuneResource
     */
    public function show(Request $request, ComuneModel $comune)
    {

        $risorsa = new ComuneResource($comune);
        return $risorsa;
    }
}
