<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SerieModel;
use App\Models\StagioneModel;
use App\Models\StreamingFileModel;

class StagioneSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $serieMap = SerieModel::pluck('id_serie', 'descrizione')->all(); // creo una mappa descrizione_serie => id_serie per trovare rapidamente la serie

        $counts = []; // preparo una struttura per contare gli episodi per (serie, stagione)

        $rows = StreamingFileModel::query() // Preparo la query sui file streaming
            ->where('descrizione', 'like', 'serie.%') // Tengo solo quelli legati alle serie
            ->get(['descrizione']); // Carico solo la descrizione perché basta per il parsing

        foreach ($rows as $row) { // Scorro tutte le descrizioni dei file streaming delle serie
            $desc = (string) $row->descrizione; // salvo la descrizione come stringa

            if (preg_match('/^(serie\.[a-z0-9_]+)\.s(\d+)\.e(\d+)$/i', $desc, $m)) { // Controllo e parsifico il formato serie.<slug>.sX.eY
                $base   = strtolower($m[1]); // ricavo la base "serie.<slug>" in minuscolo per uniformare le chiavi
                $season = (int) $m[2]; // ricavo il numero della stagione

                if (!isset($counts[$base])) { // Se è la prima volta che vedo questa serie
                    $counts[$base] = []; // Inizializzo il contenitore delle stagioni per questa serie
                }
                if (!isset($counts[$base][$season])) { // Se è la prima volta che vedo questa stagione per la serie
                    $counts[$base][$season] = 0; // Inizializzo il contatore episodi a 0
                }
                $counts[$base][$season] += 1; // Incremento il numero di episodi trovati per quella stagione
            }
        }

        foreach ($counts as $base => $stagioni) { // Scorro ogni serie con le sue stagioni conteggiate
            $idSerie = $serieMap[$base] ?? null; // Traduco la descrizione base nell'id della serie
            if (!$idSerie) { // Se non trovo la serie nel DB
                continue; // Salto perché non posso creare stagioni senza serie
            }

            foreach ($stagioni as $seasonNumber => $episodeCount) { // Scorro ogni stagione conteggiata per la serie
                $descStagione = $base . '.s' . $seasonNumber; // costruisco la descrizione tecnica della stagione

                StagioneModel::updateOrCreate( // Creo la stagione se non esiste o la aggiorno se esiste già
                    [
                        'id_serie'        => $idSerie,
                        'numero_stagione' => $seasonNumber,
                    ],
                    [
                        'descrizione'     => $descStagione,
                        'numero_episodi'  => $episodeCount,
                    ]
                );
            }
        }
    }
}
