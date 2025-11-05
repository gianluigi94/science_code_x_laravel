<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ContattoResource;

use App\Http\Resources\V1\CollectionEstesa;

use App\Models\ContattoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContattoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    if (Gate::allows('abilita', 'moderatore')) {
        $risorsa = ContattoModel::all();
        return new CollectionEstesa($risorsa, ContattoResource::class);
    }

    abort(403, "ATTENZIONE: ti manca l’abilità necessaria (moderatore).");
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
    // public function show(ContattoModel $contatto)
    // {
    //     $risorsa = new ContattoResource($contatto);
    //     return $risorsa;
    // }

 public function show(ContattoModel $contatto)
{
    $utenteAutenticato = Auth::user();

    if (Gate::allows('abilita', 'gestire_account')) {
        if (Gate::allows('ruolo', 'amministratore_principale')) {
            return new ContattoResource($contatto);
        }

        if ($utenteAutenticato->id_contatto === $contatto->id_contatto) {
            return new ContattoResource($contatto);
        }

        abort(403, "ATTENZIONE: Non hai il permesso di visualizzare questo contatto.");
    }

    abort(403, "ATTENZIONE: ti manca l’abilità necessaria (gestire_account).");
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
