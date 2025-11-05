<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SerieModel;
use App\Models\StagioneModel;
use App\Models\StreamingFileModel;

class StagioneSeeder extends Seeder
{
    public function run(): void
    {
        // Mappa descrizione serie ("serie.<slug>") -> id_serie
        $serieMap = SerieModel::pluck('id_serie', 'descrizione')->all();

        // Raggruppa gli episodi per (base "serie.<slug>", stagione N)
        // Esempio descrizione streaming: "serie.piu_piccolo_di_un_atomo.s1.e3"
        $counts = []; // es: $counts['serie.piu_piccolo_di_un_atomo'][1] = 4 (episodi)

        $rows = StreamingFileModel::query()
            ->where('descrizione', 'like', 'serie.%')
            ->get(['descrizione']);

        foreach ($rows as $row) {
            $desc = (string) $row->descrizione;

            if (preg_match('/^(serie\.[a-z0-9_]+)\.s(\d+)\.e(\d+)$/i', $desc, $m)) {
                $base   = strtolower($m[1]);       // "serie.<slug>"
                $season = (int) $m[2];             // numero stagione
                // $episode = (int) $m[3];         // numero episodio (non serve salvarlo)

                if (!isset($counts[$base])) {
                    $counts[$base] = [];
                }
                if (!isset($counts[$base][$season])) {
                    $counts[$base][$season] = 0;
                }
                $counts[$base][$season] += 1;
            }
        }

        // Crea/aggiorna stagioni in base ai conteggi
        foreach ($counts as $base => $stagioni) {
            $idSerie = $serieMap[$base] ?? null;
            if (!$idSerie) {
                // Non esiste una serie con descrizione = $base → salta
                continue;
            }

            foreach ($stagioni as $seasonNumber => $episodeCount) {
                $descStagione = $base . '.s' . $seasonNumber;

                // Idempotente: aggiorna se esiste, altrimenti crea
                StagioneModel::updateOrCreate(
                    [
                        'id_serie'        => $idSerie,
                        'numero_stagione' => $seasonNumber,
                    ],
                    [
                        'descrizione'     => $descStagione,
                        'numero_episodi'  => $episodeCount,
                    ]
                );
            }
        }
    }
}
