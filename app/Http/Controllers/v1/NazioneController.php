<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\NazioneResource;
use App\Models\NazioneModel;
use Illuminate\Http\Request;

class NazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         AppHelpers::gestisci_sessione($request);
        $risorsa = NazioneModel::all();
       return new CollectionEstesa($risorsa, NazioneResource::class);
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
    public function show(Request $request, NazioneModel $nazione)
    {
    AppHelpers::gestisci_sessione($request);
        $risorsa = new NazioneResource($nazione);
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
