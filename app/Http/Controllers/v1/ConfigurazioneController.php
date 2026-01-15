<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\ConfigurazioneResource;
use App\Models\ConfigurazioneModel;
use Illuminate\Support\Facades\Gate;

class ConfigurazioneController extends Controller
{
    /**
     * Lista tutte le configurazioni (solo "sistemista").
     *
     * @return CollectionEstesa
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
     * Mostra una singola configurazione (solo "sistemista").
     *
     * @param ConfigurazioneModel $configurazione
     * @return ConfigurazioneResource
     */
    public function show(ConfigurazioneModel $configurazione)
    {
        if (Gate::allows('abilita', 'sistemista')) {
            return new ConfigurazioneResource($configurazione);
        }

        abort(403, "ATTENZIONE: ti manca l'abilità necessaria (sistemista).");
    }
}
