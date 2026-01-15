<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\TraduzioneCustomResource;
use App\Models\TraduzioneCustomModel;
use Illuminate\Http\Request;

class TraduzioneCustomController extends Controller
{
    /**
     * Lista tutte le traduzioni custom .
     *
     * @param Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = TraduzioneCustomModel::all();
        return new CollectionEstesa($risorsa, traduzioneCustomResource::class);
    }



    /**
     * Mostra una singola traduzione custom .
     *
     * @param Request $request
     * @param TraduzioneCustomModel $traduzionecustom
     * @return TraduzioneCustomResource
     */
    public function show(Request $request, TraduzioneCustomModel $traduzionecustom)
    {
        $risorsa = new TraduzioneCustomResource($traduzionecustom);
        return $risorsa;
    }
}
