<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\FilmTraduzioneResource;
use App\Models\FilmTraduzioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FilmTraduzioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        $risorsa = FilmTraduzioneModel::all();
        return new CollectionEstesa($risorsa, FilmTraduzioneResource::class);
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
   public function show(FilmTraduzioneModel $filmtraduzione)
{
    if (Gate::allows('abilita', 'visualizzare_media')) {
        return new FilmTraduzioneResource($filmtraduzione);
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
