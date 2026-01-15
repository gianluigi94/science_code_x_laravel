<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\EpisodioModel;
use App\Models\SerieModel;
use App\Models\StagioneModel;
use App\Models\StreamingFileModel;

class EpisodioSeeder extends Seeder
{

    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */

    public function run(): void
    {
        $itPath = storage_path('app/json_db/it.json'); // Mi preparo il percorso del JSON italiano
        $itJson = is_file($itPath) ? json_decode(File::get($itPath), true) : null; // Se il file esiste lo leggo e lo decodifico, altrimenti metto null
        $videoRoot = $itJson['VIDEO'] ?? ($itJson['video'] ?? []); // Mi prendo la sezione VIDEO (gestendo anche una possibile chiave in minuscolo)

        $serieMap = SerieModel::pluck('id_serie', 'descrizione')->all(); // Mi creo una mappa descrizione_serie => id_serie per trovare rapidamente la serie

        $streams = StreamingFileModel::query() // Preparo la query sui file streaming
            ->where('descrizione', 'like', 'serie.%') // Tengo solo quelli che appartengono alle serie (prefisso "serie.")
            ->get(['id_streaming_file', 'descrizione']); // Carico solo i campi che mi servono

        foreach ($streams as $sf) { // Scorro tutti i file streaming delle serie
            $desc = (string) $sf->descrizione; // Mi salvo la descrizione come stringa

            if (!preg_match('/^(serie\.[a-z0-9_]+)\.s(\d+)\.e(\d+)$/i', $desc, $m)) { // Verifico che la descrizione rispetti il formato atteso serie.<slug>.sX.eY
                continue; // Se non rispetta il formato, salto questo file
            }

            $base            = strtolower($m[1]); // Mi ricavo la parte base "serie.<slug>" e la porto in minuscolo
            $numeroStagione  = (int) $m[2]; // Mi ricavo il numero di stagione dalla regex
            $numeroEpisodio  = (int) $m[3]; // Mi ricavo il numero di episodio dalla regex

            $idSerie = $serieMap[$base] ?? null; // Cerco l'id della serie usando la base come chiave
            if (!$idSerie) continue; // Se non trovo la serie nel DB, salto

            $descrizioneStagione = $base . '.s' . $numeroStagione; // Mi costruisco una descrizione coerente per la stagione (es. serie.foo.s1)
            $stagione = StagioneModel::updateOrCreate( // Creo la stagione se non esiste o la aggiorno se esiste già
                ['id_serie' => $idSerie, 'numero_stagione' => $numeroStagione], // Identifico univocamente la stagione per (serie, numero_stagione)
                ['descrizione' => $descrizioneStagione] // Aggiorno/imposto la descrizione della stagione
            );

            $slug = substr($base, 6); // Tolgo "serie." dalla base per ottenere solo lo slug (es. "foo")
            $sKey = (string) $numeroStagione; // Converto il numero stagione in stringa per usarlo come chiave nel JSON
            $eKey = (string) $numeroEpisodio; // Converto il numero episodio in stringa per usarlo come chiave nel JSON

            $imgAnteprima = $videoRoot[$slug]['serie'][$sKey][$eKey]['anteprima'] ?? 'placeholder.png'; // Cerco l'immagine anteprima nel JSON, altrimenti uso un placeholder

            EpisodioModel::updateOrCreate( // Creo o aggiorno l'episodio
                [
                    'id_stagione'     => $stagione->id_stagione, // Identifico l'episodio tramite la stagione
                    'numero_episodio' => $numeroEpisodio, // e il numero episodio dentro la stagione
                ],
                [
                    'id_serie'          => $idSerie, // Collego l'episodio alla serie
                    'descrizione'       => $desc, // Salvo la descrizione completa
                    'durata'            => 0, // Inizializzo la durata a 0 (verrà aggiornata in seguito da altri processi/seeder)
                    'img_anteprima'     => $imgAnteprima, // Salvo l'immagine anteprima trovata nel JSON
                    'id_streaming_file' => $sf->id_streaming_file, // Collego l'episodio al file streaming
                ]
            );
        }
    }
}
