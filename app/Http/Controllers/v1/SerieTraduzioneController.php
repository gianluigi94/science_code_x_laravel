<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\SerieResource;
use App\Http\Resources\V1\SerieTraduzioneResource;
use App\Models\SerieTraduzioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SerieTraduzioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        $risorsa = SerieTraduzioneModel::all();
        return new CollectionEstesa($risorsa, SerieTraduzioneResource::class);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
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
   public function show(SerieTraduzioneModel $serietraduzione)
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        return new SerieTraduzioneResource($serietraduzione);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
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
