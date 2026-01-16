<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\SerieModel;
use App\Models\RegistaModel;

class SerieSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json'); // costruisco il percorso del JSON con le categorie
        $data = json_decode(File::get($path), true); // Leggo il file e lo decodifico in array associativo

        if (!is_array($data)) { // Controllo che il JSON sia stato decodificato correttamente
            return; // Se non è un array valido, interrompo il seeding
        }

        $novitaSlugs = [ // definisco gli slug che voglio considerare come "novità"
            'cavalli_contro_circuiti',
            'il_mio_gatto_nella_scatola',
            'l_era_dell_alchimia',
            'rivelazioni_dalla_sonda_cassini',
            'rna_e_la_memoria_cellulare',
            'il_lungo_volo_del_coraggio',
        ];

        $registiMap = RegistaModel::pluck('id_regista', 'nome')->all(); // creo una mappa nome_regista => id_regista per fare lookup veloce

        $giaInserite = []; // preparo un set per evitare di inserire due volte la stessa serie (stesso slug)

        foreach ($data as $sezione) { // Scorro tutte le sezioni del JSON
            $posters = $sezione['posters'] ?? []; // prendo i poster della sezione (se mancano uso array vuoto)

            foreach ($posters as $p) { // Scorro ogni poster della sezione
                if (($p['tipo'] ?? null) !== 'serie') { // Controllo che il poster sia di tipo "serie"
                    continue; // Se non è una serie, lo salto
                }

                $slug = $p['videoId'] ?? null; // prendo lo slug della serie (videoId)
                if (!$slug || isset($giaInserite[$slug])) { // Se manca lo slug o l'ho già inserito, salto
                    continue; // Passo al poster successivo
                }
                $giaInserite[$slug] = true; // Segno lo slug come già inserito per evitare duplicati

                $registaNome = $p['regista'] ?? null; // prendo il nome del regista dal JSON (se presente)
                $idRegista = $registaNome && isset($registiMap[$registaNome]) // Controllo se ho un regista valido e presente nella mappa
                    ? $registiMap[$registaNome] // Se lo trovo, uso il suo id_regista
                    : 1; // Se non lo trovo, uso 1 come fallback

                $anno = isset($p['anno']) ? (int) $p['anno'] : 2000; // prendo l'anno dal JSON oppure uso 2000 come fallback

                $descrizione = 'serie.' . $slug; // costruisco la descrizione tecnica della serie (serie.<slug>)

                SerieModel::create([ // Inserisco la serie nel database
                    'id_regista'      => $idRegista,
                    'anno'            => $anno,
                    'numero_stagioni' => 0,
                    'numero_episodi'  => 0,
                    'novita'          => in_array($slug, $novitaSlugs, true),
                    'descrizione'     => $descrizione,
                ]);
            }
        }
    }
}
