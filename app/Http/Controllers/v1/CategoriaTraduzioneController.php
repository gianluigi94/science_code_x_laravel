<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoriaTraduzioneResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\CategoriaTraduzioneModel;
use Illuminate\Http\Request;

class CategoriaTraduzioneController extends Controller
{
    /**
     * Lista tutte le traduzioni categoria .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {

        $risorsa = CategoriaTraduzioneModel::all();
        return new CollectionEstesa($risorsa, CategoriaTraduzioneResource::class);
    }



    /**
     * Mostra una singola traduzione categoria .
     *
     * @param Request $request
     * @param CategoriaTraduzioneModel $categoriatraduzione
     * @return CategoriaTraduzioneResource
     */
    public function show(Request $request, CategoriaTraduzioneModel $categoriatraduzione)
    {

        $risorsa = new CategoriaTraduzioneResource($categoriatraduzione);
        return $risorsa;
    }
}
