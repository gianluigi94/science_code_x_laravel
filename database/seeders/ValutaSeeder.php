<?php

namespace Database\Seeders;

use App\Models\ValutaModel;
use Illuminate\Database\Seeder;

class ValutaSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $paths = [ // Mi preparo l'elenco dei file JSON da cui leggere le valute
            storage_path('app/json_db/valute_europee.json'), // Mi indico il file con le valute europee
            storage_path('app/json_db/valute.json'), // Mi indico il file con l'elenco generale delle valute
        ];

        $items = []; // Mi preparo un array dove accumulare tutte le valute lette dai file
        foreach ($paths as $p) { // Scorro i percorsi dei file JSON
            if (file_exists($p)) { // Controllo se il file esiste
                $decoded = json_decode(file_get_contents($p), true) ?: []; // Leggo e decodifico il JSON (se fallisce uso array vuoto)
                $items = array_merge($items, $decoded); // Unisco le valute lette al mio elenco complessivo
            }
        }

        foreach ($items as $v) { // Scorro tutte le valute raccolte
            ValutaModel::updateOrCreate( // Creo la valuta se non esiste o la aggiorno se esiste già
                ['codice_iso' => $v['codice_iso']], // Uso il codice ISO come chiave univoca
                [
                    'nome'     => $v['nome'], // Salvo/aggiorno il nome della valuta
                    'simbolo'  => $v['simbolo'], // Salvo/aggiorno il simbolo della valuta
                    'decimali' => (int) $v['decimali'], // Salvo/aggiorno i decimali come intero
                ]
            );
        }
    }
}
