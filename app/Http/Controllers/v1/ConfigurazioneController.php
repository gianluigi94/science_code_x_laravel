<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\ConfigurazioneResource;
use App\Models\ConfigurazioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConfigurazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    if (Gate::allows('abilita', 'sistemista')) {
        $risorsa = ConfigurazioneModel::all();
        return new CollectionEstesa($risorsa, ConfigurazioneResource::class);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
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
   public function show(ConfigurazioneModel $configurazione)
{
    if (Gate::allows('abilita', 'sistemista')) {
        return new ConfigurazioneResource($configurazione);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
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
