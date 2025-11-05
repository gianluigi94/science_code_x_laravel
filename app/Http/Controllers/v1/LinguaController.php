<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\LinguaResource;
use App\Models\LinguaModel;
use Illuminate\Http\Request;

class LinguaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        AppHelpers::gestisci_sessione($request);

        $risorsa = LinguaModel::all();
       return new CollectionEstesa($risorsa, LinguaResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LinguaModel $lingua)
    {
        AppHelpers::gestisci_sessione($request);
        $risorsa = new LinguaResource($lingua);
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
