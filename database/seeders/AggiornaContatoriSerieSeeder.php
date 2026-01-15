<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SerieModel;

class AggiornaContatoriSerieSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        // Conteggi basati sulle relazioni; escludono i soft-deleted di default, serve per sapere il numero stagioni/episodi di una serie
        SerieModel::query()
            ->withCount(['stagioni', 'episodi'])
            ->orderBy('id_serie')
            ->chunkById(500, function ($serieChunk) {
                foreach ($serieChunk as $s) {
                    $s->update([
                        'numero_stagioni' => $s->stagioni_count,
                        'numero_episodi'  => $s->episodi_count,
                    ]);
                }
            }, 'id_serie');
    }
}
