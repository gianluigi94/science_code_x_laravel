<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\StagioneResource;
use App\Models\StagioneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StagioneController extends Controller
{
    /**
     * Lista tutte le stagioni (solo "visualizzare_media").
     *
     * @return CollectionEstesa
     */
    public function index()
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            $risorsa = StagioneModel::all();
            return new CollectionEstesa($risorsa, StagioneResource::class);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }


    /**
     * Mostra una singola stagione (solo "visualizzare_media").
     *
     * @param StagioneModel $stagione
     * @return StagioneResource
     */
    public function show(StagioneModel $stagione)
    {
        if (Gate::allows('abilita', 'visualizzare_media')) {
            return new StagioneResource($stagione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (visualizzare_media).");
    }
}
