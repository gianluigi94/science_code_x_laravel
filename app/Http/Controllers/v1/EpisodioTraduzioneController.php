<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\EpisodioTraduzioneResource;
use App\Models\EpisodioTraduzioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EpisodioTraduzioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        $risorsa = EpisodioTraduzioneModel::all();
        return new CollectionEstesa($risorsa, EpisodioTraduzioneResource::class);
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
    public function show(EpisodioTraduzioneModel $episodiotraduzione)
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        return new EpisodioTraduzioneResource($episodiotraduzione);
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
