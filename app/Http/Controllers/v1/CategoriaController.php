<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoriaResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\CategoriaModel;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Lista tutte le categorie .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        $risorsa = CategoriaModel::all();
        return new CollectionEstesa($risorsa, CategoriaResource::class);
    }



    /**
     * Mostra una singola categoria .
     *
     * @param Request $request
     * @param CategoriaModel $categoria
     * @return CategoriaResource
     */
    public function show(Request $request, CategoriaModel $categoria)
    {

        $risorsa = new CategoriaResource($categoria);
        return $risorsa;
    }
}
