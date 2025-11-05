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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        AppHelpers::gestisci_sessione($request);

        $risorsa = CategoriaTraduzioneModel::all();
       return new CollectionEstesa($risorsa, CategoriaTraduzioneResource::class);
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
    public function show(Request $request, CategoriaTraduzioneModel $categoriatraduzione)
    {
        AppHelpers::gestisci_sessione($request);

        $risorsa = new CategoriaTraduzioneResource($categoriatraduzione);
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
