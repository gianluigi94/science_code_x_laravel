<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\StatoUtenteResource;
use App\Models\StatoUtenteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatoUtenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (Gate::allows('abilita', 'moderatore')) {
        $risorsa = StatoUtenteModel::all();
        return new CollectionEstesa($risorsa, StatoUtenteResource::class);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
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
   public function show(StatoUtenteModel $statoutente)
{
    if (Gate::allows('abilita', 'moderatore')) {
        return new StatoUtenteResource($statoutente);
    }

    abort(403, "ATTENZIONE: ti manca l'abilità necessaria (moderatore).");
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
