<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SerieModel;
use App\Models\LinguaModel;
use App\Models\SerieTraduzioneModel;
use App\Helpers\AppHelpers;

class SerieTraduzioneSeeder extends Seeder
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
        ]; // Chiudo la definizione dell'array lingue

        foreach (SerieModel::all() as $serie) { // Scorro tutte le serie presenti nel database
            $slug = preg_replace('/^serie\./i', '', trim((string) $serie->descrizione)); // Tolgo il prefisso "serie." dalla descrizione per ottenere lo slug
            if ($slug === '') { // Controllo che lo slug non sia vuoto
                continue; // Se è vuoto, salto questa serie
            }

            foreach ($lingue as $meta) { // Per ogni lingua (IT/EN) provo a trovare la traduzione nel JSON
                $video = $meta['data']['VIDEO'] ?? $meta['data']['video'] ?? []; // prendo la sezione VIDEO dal JSON (gestendo anche la chiave in minuscolo)
                $entry = $video[$slug] ?? null; // Cerco l'entry della serie usando lo slug come chiave
                if (!$entry) { // Controllo se ho trovato i metadati della serie
                    continue; // Se non li trovo, salto questa lingua
                }

                SerieTraduzioneModel::updateOrCreate( // Creo o aggiorno la traduzione della serie per questa lingua
                    [
                        'id_serie'  => $serie->id_serie, // Identifico la traduzione tramite l'id della serie
                        'id_lingua' => $meta['id'], // Identifico la traduzione anche tramite l'id della lingua
                    ],
                    [
                        'titolo'        => $entry['titolo']        ?? null, // Salvo il titolo

                        'sottotitolo'   => $entry['sottotitolo']   ?? $entry['subtitle']    ?? null, // Salvo il sottotitolo (supporto due chiavi possibili)
                        'descrizione'   => $entry['intro']         ?? $entry['descrizione'] ?? null, // Salvo descrizione/intro (supporto due chiavi possibili)
                    ]
                );
            }
        }
    }
}
