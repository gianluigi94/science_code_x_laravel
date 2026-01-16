<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FilmModel;
use App\Models\LinguaModel;
use App\Models\FilmTraduzioneModel;
use App\Helpers\AppHelpers;

class FilmTraduzioneSeeder extends Seeder
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

        foreach (FilmModel::all() as $film) { // Scorro tutti i film presenti nel database
            $slug = preg_replace('/^film\./i', '', trim((string) $film->descrizione)); // Tolgo il prefisso "film." dalla descrizione per ottenere lo slug
            if ($slug === '') { // Controllo che lo slug non sia vuoto
                continue; // Se è vuoto, salto questo film
            }

            foreach ($lingue as $meta) { // Per ogni lingua (IT/EN) provo a trovare la traduzione nel JSON
                $video = $meta['data']['VIDEO'] ?? $meta['data']['video'] ?? []; // prendo la sezione VIDEO dal JSON (gestendo anche la chiave in minuscolo)
                $entry = $video[$slug] ?? null; // Cerco l'entry del film usando lo slug come chiave
                if (!$entry) { // Controllo se ho trovato i metadati del film
                    continue; // Se non li trovo, salto questa lingua
                }

                FilmTraduzioneModel::updateOrCreate( // Creo o aggiorno la traduzione del film per questa lingua
                    [
                        'id_film'   => $film->id_film, // Identifico la traduzione tramite l'id del film
                        'id_lingua' => $meta['id'], // Identifico la traduzione anche tramite l'id della lingua
                    ],
                    [
                        'titolo'        => $entry['titolo']        ?? null, // Salvo il titolo
                        'sottotitolo'   => $entry['sottotitolo']   ?? $entry['subtitle']    ?? null, // Salvo il sottotitolo (supporto due chiavi possibili)
                        'descrizione'   => $entry['intro']         ?? $entry['descrizione'] ?? null, // Salvo la descrizione/intro (supporto due chiavi possibili)

                    ]
                );
            }
        }
    }
}
