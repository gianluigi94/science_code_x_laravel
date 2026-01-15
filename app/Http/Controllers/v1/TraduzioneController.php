<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\TraduzioneResource;
use App\Models\TraduzioneModel;
use Illuminate\Http\Request;

class TraduzioneController extends Controller
{
    /**
     * Lista tutte le traduzioni .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = TraduzioneModel::all();
        return new CollectionEstesa($risorsa, TraduzioneResource::class);
    }


    /**
     * Mostra una singola traduzione .
     *
     * @param Request $request
     * @param TraduzioneModel $traduzione
     * @return TraduzioneResource
     */
    public function show(Request $request, TraduzioneModel $traduzione)
    {

        $risorsa = new TraduzioneResource($traduzione);
        return $risorsa;
    }
}
