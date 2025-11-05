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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         AppHelpers::gestisci_sessione($request);
         $risorsa = TipoRecapitoModel::all();
        return new CollectionEstesa($risorsa, TipoRecapitoResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
     public function show(Request $request, TipoRecapitoModel $tipo)
{
    AppHelpers::gestisci_sessione($request, $tipo);
    $risorsa = new TipoRecapitoResource($tipo);
    return $risorsa;
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
