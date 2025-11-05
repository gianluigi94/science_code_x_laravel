<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\EpisodioResource;
use App\Models\EpisodioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        $risorsa = EpisodioModel::all();
        return new CollectionEstesa($risorsa, EpisodioResource::class);
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
     public function show(EpisodioModel $episodio)
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        return new EpisodioResource($episodio);
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
