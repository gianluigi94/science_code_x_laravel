<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AliquotaResource;
use App\Http\Resources\V1\CollectionEstesa;
use App\Models\AliquotaModel;
use Illuminate\Http\Request;

class AliquotaController extends Controller
{
    /**
     * Lista tutte le aliquote .
     *
     * @param Request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = AliquotaModel::all();
        return new CollectionEstesa($risorsa, AliquotaResource::class);
    }

    /**
     * Mostra una singola aliquota .
     *
     * @param Request
     * @param AliquotaModel $aliquota
     * @return AliquotaResource
     */
    public function show(Request $request, AliquotaModel $aliquota)
    {
        $risorsa = new AliquotaResource($aliquota);
        return $risorsa;
    }
}
