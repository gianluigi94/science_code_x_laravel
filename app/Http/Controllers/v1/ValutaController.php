<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\ValutaResource;
use App\Models\ValutaModel;
use Illuminate\Http\Request;

class ValutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        AppHelpers::gestisci_sessione($request);
        $risorsa = ValutaModel::all();
        return new CollectionEstesa($risorsa, ValutaResource::class);
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
    public function show(Request $request, ValutaModel $valuta)
    {
        AppHelpers::gestisci_sessione($request);
                 $risorsa = new ValutaResource($valuta);
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
