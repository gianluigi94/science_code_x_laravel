<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FilmModel;
use App\Models\EpisodioModel;
use App\Models\StreamingFileModel;
use Symfony\Component\Process\Process;

class DurataVideoSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */

    public function run(): void
    {
        // Mappa streaming per lookup rapido // preparo i dati streaming in memoria per evitare query ripetute dentro i loop
        $streaming = StreamingFileModel::get(['id_streaming_file', 'descrizione', 'url_auto']); // Recupero id, descrizione e url del file streaming
        $byId   = $streaming->keyBy('id_streaming_file'); // indicizzo i file streaming per id_streaming_file
        $byDesc = $streaming->keyBy('descrizione'); // indicizzo i file streaming per descrizione (fallback per gli episodi)

        // FILM
        $films = FilmModel::query() // Preparo la query sui film
            ->whereNotNull('id_streaming_file') // Tengo solo i film che hanno un id_streaming_file valorizzato
            ->get(['id_film', 'durata', 'id_streaming_file']); // Carico solo i campi che servono

        foreach ($films as $film) { // Scorro tutti i film selezionati
            $sf = $byId->get($film->id_streaming_file); // Recupero il file streaming associato al film usando la mappa per id
            if (!$sf || empty($sf->url_auto)) continue; // Se non trovo il file o manca l'url, salto il film

            $seconds = $this->probeSeconds($sf->url_auto); // Calcolo la durata reale del video (in secondi) interrogando ffprobe
            if (!is_int($seconds) || $seconds <= 0) continue; // Se non ottengo una durata valida, salto il film

            $curr = (int) ($film->getAttribute('durata') ?? 0); // Leggo la durata attuale dal DB (0 se manca)
            if ($curr !== $seconds) { // Se la durata salvata è diversa da quella reale
                $film->setAttribute('durata', $seconds); // Aggiorno la durata del film con il valore corretto
                $film->save(); // Salvo la modifica nel database
            }
        }

        // EPISODI
        $episodes = EpisodioModel::query() // Preparo la query sugli episodi
            ->get(['id_episodio', 'durata', 'id_streaming_file', 'descrizione']); // Carico i campi necessari (id streaming o descrizione per il lookup)

        foreach ($episodes as $ep) { // Scorro tutti gli episodi
            $sf = $ep->id_streaming_file ? $byId->get($ep->id_streaming_file) : null; // Se ho id_streaming_file, cerco subito il file streaming per id
            if (!$sf && $ep->descrizione) $sf = $byDesc->get($ep->descrizione); // Se non ho trovato per id, provo a cercare per descrizione come fallback
            if (!$sf || empty($sf->url_auto)) continue; // Se non trovo il file o manca l'url, salto l'episodio

            $seconds = $this->probeSeconds($sf->url_auto); // Calcolo la durata reale dell'episodio con ffprobe
            if (!is_int($seconds) || $seconds <= 0) continue; // Se la durata non è valida, salto l'episodio

            $curr = (int) ($ep->getAttribute('durata') ?? 0); // Leggo la durata attuale dell'episodio (0 se manca)
            if ($curr !== $seconds) { // Se la durata salvata è diversa da quella reale
                $ep->setAttribute('durata', $seconds); // Aggiorno la durata dell'episodio
                $ep->save(); // Salvo nel database
            }
        }
    }


    /**
     * Ricavo la durata del video (in secondi) interrogando ffprobe sull'URL del file.
     *
     * @param string $url URL/percorso del file video da analizzare
     * @return int|null Durata arrotondata in secondi, oppure null se non disponibile/errore
     */
    private function probeSeconds(string $url): ?int
    {
        $bin = env('FFPROBE_BIN', 'ffprobe'); // Mi prendo il percorso del binario ffprobe da env (o uso "ffprobe" di default)
        $cmd = [ // Mi costruisco il comando da eseguire
            $bin,
            '-v',
            'error', // Eseguo ffprobe mostrando solo errori
            '-show_entries',
            'format=duration', // Chiedo a ffprobe solo la durata del formato
            '-of',
            'default=noprint_wrappers=1:nokey=1', // Imposto un output "solo valore" senza etichette
            $url, // Passo l'URL/percorso del video da analizzare
        ];

        $p = new Process($cmd); // Creo un processo di sistema con il comando preparato
        $p->setTimeout(null);
        $p->run(); // Eseguo il comando

        if (!$p->isSuccessful()) return null; // Se ffprobe fallisce, ritorno null

        $out = trim($p->getOutput()); // Mi prendo l'output e tolgo spazi e a capo
        if ($out === '' || !is_numeric($out)) return null; // Se non ho un numero valido, ritorno null

        $sec = (float) $out; // Converto la durata in secondi (float, perché ffprobe può dare decimali)
        return ($sec > 0 && is_finite($sec)) ? (int) round($sec) : null; // Se è valida, arrotondo e ritorno i secondi, altrimenti null
    }
}
