<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriaTraduzioneSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $pathIt = storage_path('app/json_db/it.json'); // Mi preparo il percorso del file JSON
        $pathEn = storage_path('app/json_db/en.json');

        $jsonIt = json_decode(File::get($pathIt), true); // Leggo e decodifico il JSON
        $jsonEn = json_decode(File::get($pathEn), true);

        $categorieIt = $jsonIt['CATEGORIA']; // Estraggo l'array delle categorie in italiano
        $categorieEn = $jsonEn['CATEGORIA']; // Estraggo l'array delle categorie in inglese

        unset($categorieIt['continua_a_guardare']); // Tolgo la voce "continua_a_guardare" perché non la voglio tra le categorie
        unset($categorieIt['i_preferiti']); // Tolgo la voce "i_preferiti" perché non la voglio tra le categorie
        unset($categorieIt['i_piu_visti']); // Tolgo la voce "i_piu_visti" perché non la voglio tra le categorie
        unset($categorieEn['continua_a_guardare']);
        unset($categorieEn['i_preferiti']);
        unset($categorieEn['i_piu_visti']);

        $id = 1; // Inizio a contare gli id_categoria partendo da 1
        $now = now(); // Mi salvo il timestamp attuale da usare per created_at/updated_at

        foreach ($categorieIt as $codice => $labelIt) { // Scorro tutte le categorie italiane (codice => etichetta)
            $labelEn = $categorieEn[$codice] ?? $labelIt; // Se ho la traduzione inglese la uso, altrimenti ripiego sull'italiano

            DB::table('categorie_traduzioni')->insert([ // Inserisco in tabella le due righe di traduzione (IT e EN) per la stessa categoria
                [
                    'id_categoria' => $id, // Associo la traduzione all'id della categoria corrente
                    'id_lingua'    => 1, // Indico che questa riga è in lingua italiana
                    'nome'         => $labelIt, // Salvo il nome della categoria in italiano
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ],
                [
                    'id_categoria' => $id, // Associo anche l'inglese allo stesso id_categoria
                    'id_lingua'    => 2, // Indico che questa riga è in lingua inglese
                    'nome'         => $labelEn, // Salvo il nome della categoria in inglese
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ],
            ]);

            $id++; // Passo alla categoria successiva incrementando l'id
        }
    }
}
