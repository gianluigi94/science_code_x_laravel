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
     * Lista tutte le nazioni .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = NazioneModel::all();
        return new CollectionEstesa($risorsa, NazioneResource::class);
    }



    /**
     * Mostra una singola nazione .
     *
     * @param Request $request
     * @param NazioneModel $nazione
     * @return NazioneResource
     */
    public function show(Request $request, NazioneModel $nazione)
    {
        $risorsa = new NazioneResource($nazione);
        return $risorsa;
    }
}
