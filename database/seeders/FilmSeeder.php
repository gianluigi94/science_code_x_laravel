<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\FilmModel;
use App\Models\RegistaModel;
use App\Models\StreamingFileModel;

class FilmSeeder extends Seeder
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

        $DEFAULT_DURATA_MINUTI = 90; // imposto la durata di default (in minuti) quando non ho quella reale
        $DEFAULT_ID_STREAMING_FILE = 1; // imposto l'id streaming di default quando non trovo una corrispondenza

        $registiMap = RegistaModel::pluck('id_regista', 'nome')->all(); // creo una mappa nome_regista => id_regista
        $streamingMap = StreamingFileModel::pluck('id_streaming_file', 'descrizione')->all(); // creo una mappa descrizione => id_streaming_file per collegare il film al file streaming

        $giaInseriti = []; // preparo un set per evitare di inserire due volte lo stesso film (stesso slug)

        foreach ($data as $sezione) { // Scorro tutte le sezioni del JSON
            $posters = $sezione['posters'] ?? []; // prendo i poster della sezione (se mancano uso array vuoto)

            foreach ($posters as $p) { // Scorro ogni poster della sezione
                if (($p['tipo'] ?? null) !== 'film') continue; // Se il poster non è un film, lo salto

                $slug = $p['videoId'] ?? null; // prendo lo slug del film (videoId)
                if (!$slug || isset($giaInseriti[$slug])) continue; // Se manca lo slug o l'ho già inserito, salto
                $giaInseriti[$slug] = true; // Segno lo slug come già inserito per evitare duplicati

                $registaNome = $p['regista'] ?? null; // prendo il nome del regista dal JSON (se presente)
                $idRegista = $registaNome && isset($registiMap[$registaNome]) // Controllo se ho un regista valido e presente nella mappa
                    ? $registiMap[$registaNome] // Se lo trovo, uso il suo id_regista
                    : 1; // Se non lo trovo, uso 1 come fallback

                $anno = isset($p['anno']) ? (int) $p['anno'] : 2000; // prendo l'anno dal JSON oppure uso 2000 come fallback
                $imgSfondo = $p['img_hero'] ?? 'placeholder.webp'; // prendo l'immagine di sfondo oppure uso un placeholder
                $durata = $DEFAULT_DURATA_MINUTI; // Imposto la durata di default (verrà eventualmente aggiornata altrove)

                $descrizione = 'film.' . $slug; // costruisco la descrizione tecnica del film (usata anche per il mapping streaming)
                $idStreamingFile = $streamingMap[$descrizione] ?? $DEFAULT_ID_STREAMING_FILE; // Cerco l'id streaming corrispondente oppure uso il default

                FilmModel::create([ // Inserisco il film nel database
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
