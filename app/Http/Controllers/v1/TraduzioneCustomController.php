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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        AppHelpers::gestisci_sessione($request);
        $risorsa = TraduzioneCustomModel::all();
       return new CollectionEstesa($risorsa, traduzioneCustomResource::class);
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
    public function show(Request $request, TraduzioneCustomModel $traduzionecustom)
    {
        AppHelpers::gestisci_sessione($request);
        $risorsa = new TraduzioneCustomResource($traduzionecustom);
        return $risorsa;
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
