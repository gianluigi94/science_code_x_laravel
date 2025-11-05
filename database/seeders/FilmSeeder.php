<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\FilmModel;
use App\Models\RegistaModel;
use App\Models\StreamingFileModel; // <— aggiunto

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json');
        $data = json_decode(File::get($path), true);

        if (!is_array($data)) {
            return;
        }

        // Slug considerati come "novità" (stessa lista delle serie)
        $novitaSlugs = [
            'cavalli_contro_circuiti',
            'il_mio_gatto_nella_scatola',
            'l_era_dell_alchimia',
            'rivelazioni_dalla_sonda_cassini',
            'rna_e_la_memoria_cellulare',
            'il_lungo_volo_del_coraggio',
        ];

        // Valori di default richiesti
        $DEFAULT_DURATA_MINUTI = 90;
        $DEFAULT_ID_STREAMING_FILE = 1;

        // Mappa rapida: nome regista → id_regista
        $registiMap = RegistaModel::pluck('id_regista', 'nome')->all();

        // Mappa descrizione → id_streaming_file (es. "film.il_mio_slug" → 12)
        $streamingMap = StreamingFileModel::pluck('id_streaming_file', 'descrizione')->all();

        // Evita duplicati sugli slug dei film
        $giaInseriti = [];

        foreach ($data as $sezione) {
            $posters = $sezione['posters'] ?? [];

            foreach ($posters as $p) {
                if (($p['tipo'] ?? null) !== 'film') continue;

                $slug = $p['videoId'] ?? null;
                if (!$slug || isset($giaInseriti[$slug])) continue;
                $giaInseriti[$slug] = true;

                // id_regista (fallback 1 se non trovato)
                $registaNome = $p['regista'] ?? null;
                $idRegista = $registaNome && isset($registiMap[$registaNome])
                    ? $registiMap[$registaNome]
                    : 1;

                // campi base
                $anno = isset($p['anno']) ? (int) $p['anno'] : 2000;
                $imgSfondo = $p['img_hero'] ?? 'placeholder.webp';
                $durata = $DEFAULT_DURATA_MINUTI;

                // descrizione film e lookup streaming_file
                $descrizione = 'film.' . $slug;
                $idStreamingFile = $streamingMap[$descrizione] ?? $DEFAULT_ID_STREAMING_FILE;

                FilmModel::create([
                    'id_regista'        => $idRegista,
                    'anno'              => $anno,
                    'durata'            => $durata,
                    'img_sfondo'        => $imgSfondo,
                    'id_streaming_file' => $idStreamingFile,
                    'novita'            => in_array($slug, $novitaSlugs, true),
                    'descrizione'       => $descrizione,
                ]);
            }
        }
    }
}
