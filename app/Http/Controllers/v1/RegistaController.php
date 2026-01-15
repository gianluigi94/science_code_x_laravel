<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\RegistaResource;
use App\Models\RegistaModel;
use Illuminate\Http\Request;

class RegistaController extends Controller
{
    /**
     * Lista tutti i registi .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = RegistaModel::all();
        return new CollectionEstesa($risorsa, RegistaResource::class);
    }



    /**
     * Mostra un singolo regista .
     *
     * @param Request $request
     * @param RegistaModel $regista
     * @return RegistaResource
     */
    public function show(Request $request, RegistaModel $regista)
    {
        $risorsa = new RegistaResource($regista);
        return $risorsa;
    }
}
