<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\VcategorieLocandineResource;
use App\Models\VcategorieLocandineModel;
use Illuminate\Http\Request;

class VcategorieLocandineController extends Controller
{
    /**
     * Lista le locandine per categoria.
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
                $risorsa = VcategorieLocandineModel::orderBy('id_categoria')
            ->orderBy('tipo')
            ->orderBy('id_contenuto')
            ->get();

        return new CollectionEstesa($risorsa, VcategorieLocandineResource::class);
    }

    /**
     * Mostra la locandina in posizione $indice (partendo da 1) ordinata per id_categoria.
     *
     * @param Request $request
     * @param int $indice
     * @return VcategorieLocandineResource
     */
    public function show(Request $request, int $indice)
    {
        if ($indice < 1) {
            abort(404);
        }

                $record = VcategorieLocandineModel::orderBy('id_categoria')
            ->orderBy('tipo')
            ->orderBy('id_contenuto')
            ->skip($indice - 1)
            ->take(1)
            ->firstOrFail();

        return new VcategorieLocandineResource($record);
    }
}
