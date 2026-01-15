<?php

namespace App\Http\Controllers\v1;

use App\Helpers\AppHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionEstesa;
use App\Http\Resources\V1\VTraduzioneEffettivaResource;
use App\Models\VTraduzioneEffettivaModel;
use Illuminate\Http\Request;

class VTraduzioneEffettivaController extends Controller
{
    /**
     * Lista tutte le traduzioni effettive (vista) .
     *
     * @param \Illuminate\Http\Request $request
     * @return CollectionEstesa
     */
    public function index(Request $request)
    {
        $risorsa = VTraduzioneEffettivaModel::all();
        return new CollectionEstesa($risorsa, VTraduzioneEffettivaResource::class);
    }



    /**
     * Mostra una singola traduzione effettiva (vista) .
     *
     * @param Request $request
     * @param VTraduzioneEffettivaModel $traduzioneeffettiva
     * @return VTraduzioneEffettivaResource
     */
    public function show(Request $request, VTraduzioneEffettivaModel $traduzioneeffettiva)
    {
        $risorsa = new VTraduzioneEffettivaResource($traduzioneeffettiva);
        return $risorsa;
    }
}
