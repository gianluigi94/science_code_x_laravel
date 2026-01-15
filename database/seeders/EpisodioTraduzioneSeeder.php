<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EpisodioModel;
use App\Models\LinguaModel;
use App\Models\EpisodioTraduzioneModel;
use App\Helpers\AppHelpers;

class EpisodioTraduzioneSeeder extends Seeder
{

    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */

    public function run(): void
    {
        $it = LinguaModel::firstOrCreate(['codice' => 'it'], ['nome' => 'italiano']); // Mi assicuro che la lingua IT esista (se manca la creo)
        $en = LinguaModel::firstOrCreate(['codice' => 'en'], ['nome' => 'inglese']); // Mi assicuro che la lingua EN esista (se manca la creo)

        $lingue = [ // Mi preparo una lista di lingue con id lingua e JSON già caricato
            ['id' => (int) ($it->id_lingua ?? $it->id), 'data' => AppHelpers::loadLangJson('it')], // salvo l'id della lingua IT e carico it.json
            ['id' => (int) ($en->id_lingua ?? $en->id), 'data' => AppHelpers::loadLangJson('en')], // salvo l'id della lingua EN e carico en.json
        ];

        foreach (EpisodioModel::all() as $ep) { // Scorro tutti gli episodi presenti nel database
            $desc = trim((string) $ep->descrizione); // prendo la descrizione dell'episodio (che contiene lo slug) e la pulisco
            if (!preg_match('/^serie\.([^.]+)\.s(\d+)\.e(\d+)/i', $desc, $m)) continue; // Se la descrizione non segue il formato atteso, salto l'episodio

            $slug = $m[1]; // Estraggo lo slug della serie dalla descrizione
            $stagione = (string) ((int) $m[2]); // Estraggo il numero stagione e lo normalizzo come stringa
            $episodio = (string) ((int) $m[3]); // Estraggo il numero episodio e lo normalizzo come stringa

            foreach ($lingue as $meta) { // Per ogni lingua (IT/EN) provo a trovare la traduzione nel JSON
                $video = $meta['data']['VIDEO'] ?? $meta['data']['video'] ?? []; // prendo la sezione VIDEO dal JSON (gestendo anche la chiave in minuscolo)
                $entry = $video[$slug]['serie'][$stagione][$episodio] ?? null; // Vado a cercare la voce del singolo episodio nel JSON
                if (!$entry) continue; // Se non trovo la voce nel JSON, salto questa lingua

                EpisodioTraduzioneModel::updateOrCreate( // Creo o aggiorno la traduzione dell'episodio per quella lingua
                    ['id_episodio' => $ep->id_episodio ?? $ep->id, 'id_lingua' => $meta['id']], // Identifico univocamente la traduzione per (episodio, lingua)
                    [
                        'titolo'      => $entry['titolo'] ?? null, // Salvo il titolo se presente nel JSON
                        'descrizione' => $entry['descrizione'] ?? null, // Salvo la descrizione se presente nel JSON
                    ]
                );
            }
        }
    }
}
