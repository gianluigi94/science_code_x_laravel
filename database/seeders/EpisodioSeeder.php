<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File; // <— aggiunto
use App\Models\EpisodioModel;
use App\Models\SerieModel;
use App\Models\StagioneModel;
use App\Models\StreamingFileModel;

class EpisodioSeeder extends Seeder
{
    public function run(): void
    {
        // ===== 1) Carica it.json per le anteprime =====
        $itPath = storage_path('app/json_db/it.json');
        $itJson = is_file($itPath) ? json_decode(File::get($itPath), true) : null;
        // Accetta VIDEO o video come chiave
        $videoRoot = $itJson['VIDEO'] ?? ($itJson['video'] ?? []);

        // ===== 2) Mappa "serie.<slug>" -> id_serie =====
        $serieMap = SerieModel::pluck('id_serie', 'descrizione')->all();

        // ===== 3) Prendi streaming descrizione tipo: serie.<slug>.sN.eM =====
        $streams = StreamingFileModel::query()
            ->where('descrizione', 'like', 'serie.%')
            ->get(['id_streaming_file', 'descrizione']);

        foreach ($streams as $sf) {
            $desc = (string) $sf->descrizione;

            // Match "serie.slug.s<stagione>.e<episodio>"
            if (!preg_match('/^(serie\.[a-z0-9_]+)\.s(\d+)\.e(\d+)$/i', $desc, $m)) {
                continue;
            }

            $base            = strtolower($m[1]);       // "serie.<slug>"
            $numeroStagione  = (int) $m[2];
            $numeroEpisodio  = (int) $m[3];

            // id_serie
            $idSerie = $serieMap[$base] ?? null;
            if (!$idSerie) continue;

            // Trova/crea stagione
            $descrizioneStagione = $base . '.s' . $numeroStagione;
            $stagione = StagioneModel::updateOrCreate(
                ['id_serie' => $idSerie, 'numero_stagione' => $numeroStagione],
                ['descrizione' => $descrizioneStagione]
            );

            // ===== 4) Ricava img_anteprima da it.json =====
            // base = "serie.<slug>" → tolgo "serie." per ottenere lo slug
            $slug = substr($base, 6); // rimuove "serie."
            $sKey = (string) $numeroStagione;
            $eKey = (string) $numeroEpisodio;

            $imgAnteprima = $videoRoot[$slug]['serie'][$sKey][$eKey]['anteprima'] ?? 'placeholder.png';

            // ===== 5) Crea/aggiorna episodio =====
            EpisodioModel::updateOrCreate(
                [
                    'id_stagione'     => $stagione->id_stagione,
                    'numero_episodio' => $numeroEpisodio,
                ],
                [
                    'id_serie'          => $idSerie,
                    'descrizione'       => $desc,              // es: serie.slug.s1.e3
                    'durata'            => 0,                  // fittizio per ora
                    'img_anteprima'     => $imgAnteprima,      // ← preso da it.json
                    'id_streaming_file' => $sf->id_streaming_file,
                ]
            );
        }
    }
}
