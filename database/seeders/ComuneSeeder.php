<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ComuneSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $pathA = storage_path('app/csv_db/gi_comuni_cap.csv'); // salvo i percorso del CSV con l'anagrafica dei comuni
        $pathB = storage_path('app/csv_db/gi_cap.csv'); // salvo il percorso del CSV con l'elenco dei CAP per codice ISTAT

        $agg = $this->buildCapAggregation($pathB, ';'); // Mi costruisco la mappa di aggregazione dei CAP

        $this->seedComuni($pathA, ';', $agg); // Inserisco/aggiorno i comuni nel DB usando il file anagrafico e l'aggregazione CAP
    }


    /**
     * Costruisco un'aggregazione dei CAP per codice ISTAT leggendo il CSV dei CAP.
     * Per ogni ISTAT restituisco:
     * - n_cap: numero di CAP distinti
     * - cap_start: primo CAP (ordinato)
     * - cap_end: ultimo CAP (ordinato)
     *
     * @param string $file Percorso del CSV (es. gi_cap.csv)
     * @param string $sep  Separatore CSV (es. ';')
     * @return array<string, array{n_cap:int, cap_start:?string, cap_end:?string}>
     */
    private function buildCapAggregation(string $file, string $sep): array
    {
        $capsByIstat = []; // Mi preparo una struttura per raccogliere i CAP raggruppati per codice ISTAT

        if (!is_readable($file)) { // Controllo che il file esista e sia leggibile
            $this->command?->warn("File CAP non trovato o non leggibile: $file"); // Avviso in console che manca o non è leggibile
            return []; // Se non posso leggerlo, ritorno un array vuoto
        }

        $h = fopen($file, 'r'); // Apro il file in lettura e ottengo l'handle
        if (!$h) { // Verifico che l'apertura sia andata a buon fine
            $this->command?->warn("Impossibile aprire il file CAP: $file"); // Avviso in console che non sono riuscito ad aprirlo
            return []; // Se non si apre, torno un array vuoto
        }

        $header = fgetcsv($h, 0, $sep); // Leggo la prima riga del CSV (header)
        $header = $this->normalizeHeader($header); // Normalizzo i nomi delle colonne per cercarle in modo consistente

        $iIstat = array_search('codice_istat', $header, true); // Cerco l'indice della colonna "codice_istat"
        $iCap   = array_search('cap',           $header, true); // Cerco l'indice della colonna "cap"

        if ($iIstat === false || $iCap === false) { // Se non trovo una delle due colonne richieste
            fclose($h); // Chiudo il file prima di uscire
            $this->command?->warn("Header non atteso in gi_cap.csv: servono 'codice_istat' e 'cap'"); // Avviso che l'header non è quello atteso
            return []; // Ritorno vuoto perché non posso interpretare il file
        }

        while (($row = fgetcsv($h, 0, $sep)) !== false) { // Scorro tutte le righe del CSV
            if (count($row) === 1 && trim($row[0]) === '') continue; // Se la riga è vuota, la salto

            $istat = trim((string)($row[$iIstat] ?? '')); // Estraggo e pulisco il codice ISTAT dalla colonna corretta
            $cap   = $this->normalizeCap($row[$iCap] ?? ''); // Estraggo il CAP e lo normalizzo a 5 cifre

            if ($istat === '' || $cap === null) continue; // Se manca ISTAT o il CAP non è valido, salto la riga

            $capsByIstat[$istat][$cap] = true; // Registro il CAP come presente per quell'ISTAT (uso true per evitare duplicati)
        }
        fclose($h); // Chiudo il file perché ho finito di leggerlo

        $agg = []; // Mi preparo l'array finale di aggregazione da restituire
        foreach ($capsByIstat as $istat => $set) { // Scorro ogni ISTAT con il suo insieme di CAP
            $caps = array_keys($set); // Estraggo la lista dei CAP unici
            sort($caps, SORT_STRING); // Ordino i CAP in modo da poter prendere il primo e l'ultimo
            $n = count($caps); // Calcolo quanti CAP ci sono per quel comune
            $agg[$istat] = [ // Salvo l'aggregazione per questo codice ISTAT
                'n_cap'     => $n, // Mi salvo il numero totale di CAP
                'cap_start' => $n ? $caps[0] : null, // Mi salvo il primo CAP (min) se esiste
                'cap_end'   => $n ? $caps[$n - 1] : null, // Mi salvo l'ultimo CAP (max) se esiste
            ];
        }

        return $agg;
    }



    /**
     * Popolo la tabella `comuni` a partire dal CSV anagrafico:
     * - svuoto la tabella
     * - leggo righe e colonne (ISTAT, comune, regione, sigla, belfiore, lat/lon, capoluogo, CAP)
     * - arricchisco con i metadati CAP provenienti da $agg
     * - scrivo su DB con upsert a blocchi (batch) usando `codice_istat` come chiave.
     *
     * @param string $file Percorso del CSV anagrafico (es. gi_comuni_cap.csv)
     * @param string $sep  Separatore CSV (es. ';')
     * @param array<string, array{n_cap:int, cap_start:?string, cap_end:?string}> $agg Aggregazione CAP per codice ISTAT
     * @return void
     */
    private function seedComuni(string $file, string $sep, array $agg): void
    {
        if (!is_readable($file)) { // Controllo che il CSV anagrafico esista e sia leggibile
            $this->command?->error("File anagrafica non trovato o non leggibile: $file"); // Segnalo l'errore in console
            return; // Se non posso leggerlo, interrompo il seeding
        }

        Schema::disableForeignKeyConstraints(); // Disabilito i vincoli FK per poter svuotare la tabella senza problemi
        DB::table('comuni')->truncate(); // Svuoto completamente la tabella dei comuni prima di reinserire i dati
        Schema::enableForeignKeyConstraints(); // Riabilito i vincoli FK dopo il truncate

        $h = fopen($file, 'r'); // Apro il CSV in lettura
        if (!$h) { // Controllo che l'apertura sia riuscita
            $this->command?->error("Impossibile aprire il file anagrafica: $file"); // Segnalo l'errore in console
            return; // Se non si apre, interrompo
        }

        $header = fgetcsv($h, 0, $sep); // Leggo la prima riga (header) del CSV
        $header = $this->normalizeHeader($header); // Normalizzo i nomi delle colonne per cercarle in modo affidabile

        $iIstat     = array_search('codice_istat',           $header, true); // Trovo l'indice della colonna del codice ISTAT
        $iComune    = array_search('denominazione_ita',      $header, true); // Provo a trovare la colonna del nome comune (versione 1)
        if ($iComune === false) { // Se la colonna non esiste con quel nome
            $iComune = array_search('denominazione', $header, true); // Provo con un nome alternativo
            if ($iComune === false) { // Se ancora non la trovo
                $iComune = array_search('denominazione_ita_altra', $header, true); // Provo con un terzo nome alternativo
            }
        }
        $iCapMain   = array_search('cap',                    $header, true); // Trovo l'indice della colonna CAP principale
        $iSigla     = array_search('sigla_provincia',        $header, true); // Trovo l'indice della sigla provincia
        $iRegione   = array_search('denominazione_regione',  $header, true); // Trovo l'indice della regione
        $iBelfiore  = array_search('codice_belfiore',        $header, true); // Trovo l'indice del codice Belfiore
        $iLat       = array_search('lat',                    $header, true); // Trovo l'indice della latitudine
        $iLon       = array_search('lon',                    $header, true); // Trovo l'indice della longitudine
        $iFlagCap   = array_search('flag_capoluogo',         $header, true); // Trovo l'indice del flag "capoluogo"

        $batch = []; // Preparo un array per inserire i record a blocchi
        $now = now(); // Mi salvo il timestamp da usare per created_at/updated_at
        $seen = []; // Mi preparo un set per evitare duplicati di codice ISTAT

        while (($row = fgetcsv($h, 0, $sep)) !== false) { // Scorro tutte le righe del CSV
            if (count($row) === 1 && trim($row[0]) === '') continue; // Se la riga è vuota, la salto

            $istat = trim((string)($row[$iIstat] ?? '')); // Estraggo e pulisco il codice ISTAT
            if ($istat === '') continue; // Se manca l'ISTAT, salto la riga

            if (isset($seen[$istat])) continue; // Se ho già processato questo ISTAT, salto per non duplicare
            $seen[$istat] = true; // Segno l'ISTAT come già visto

            $comune   = trim((string)($row[$iComune] ?? '')); // Estraggo il nome del comune
            $regione  = trim((string)($row[$iRegione] ?? '')); // Estraggo la regione
            $sigla    = strtoupper(trim((string)($row[$iSigla] ?? ''))); // Estraggo e metto in maiuscolo la sigla provincia
            $belfiore = strtoupper(trim((string)($row[$iBelfiore] ?? ''))); // Estraggo e metto in maiuscolo il codice Belfiore

            $lat = $this->toDecimal($row[$iLat] ?? null); // Converto la latitudine in float (gestendo virgole e null)
            $lon = $this->toDecimal($row[$iLon] ?? null); // Converto la longitudine in float (gestendo virgole e null)

            $capMain = $this->normalizeCap($row[$iCapMain] ?? null); // Normalizzo il CAP principale a 5 cifre

            $flag = strtoupper(trim((string)($row[$iFlagCap] ?? ''))); // Leggo e normalizzo il flag capoluogo
            $isCapoluogo = in_array($flag, ['SI', 'SÌ', 'SI\'', 'YES', 'Y', '1'], true); // Decido se è capoluogo in base ai valori accettati

            $meta = $agg[$istat] ?? ['n_cap' => ($capMain ? 1 : 0), 'cap_start' => $capMain, 'cap_end' => $capMain]; // Prendo i metadati CAP dall'aggregazione o mi creo un fallback
            $multi = ($meta['n_cap'] ?? 0) > 1 ? 1 : 0; // Capisco se il comune ha più di un CAP
            $capStart = $multi ? ($meta['cap_start'] ?? null) : null; // Se ho più CAP, salvo il CAP iniziale
            $capEnd   = $multi ? ($meta['cap_end']   ?? null) : null; // Se ho più CAP, salvo il CAP finale

            if (!$capMain && ($meta['cap_start'] ?? null)) { // Se non ho un CAP principale ma ho un cap_start aggregato
                $capMain = $meta['cap_start']; // Uso cap_start come CAP principale di fallback
            }

            $batch[] = [ // Aggiungo il record del comune al batch di inserimento
                'comune'               => $comune, // Salvo il nome del comune
                'regione'              => $regione, // Salvo la regione
                'sigla_automobilistica' => $sigla, // Salvo la sigla automobilistica
                'codice_belfiore'      => $belfiore, // Salvo il codice Belfiore
                'lat'                  => $lat, // Salvo la latitudine
                'lon'                  => $lon, // Salvo la longitudine
                'is_capoluogo'         => $isCapoluogo ? 1 : 0, // Salvo se è capoluogo come 0/1
                'multi_cap'            => $multi, // Salvo se ha più CAP come 0/1
                'cap'                  => $capMain ?? '', // Salvo il CAP principale (stringa vuota se manca)
                'cap_inizio'           => $capStart, // Salvo il CAP iniziale (solo se multi_cap)
                'cap_fine'             => $capEnd, // Salvo il CAP finale (solo se multi_cap)
                'codice_istat'         => $istat, // Salvo il codice ISTAT come chiave univoca
                'created_at'           => $now, // Imposto created_at
                'updated_at'           => $now, // Imposto updated_at
            ];

            if (count($batch) === 1000) { // Se ho raggiunto 1000 record, scrivo su DB
                DB::table('comuni')->upsert( // Inserisco o aggiorno in base al codice ISTAT
                    $batch, // Passo il blocco di righe da scrivere
                    ['codice_istat'], // Dico che la chiave di conflitto è codice_istat
                    [ // Indico quali colonne aggiornare in caso di record già esistente
                        'comune',
                        'regione',
                        'sigla_automobilistica',
                        'codice_belfiore',
                        'lat',
                        'lon',
                        'is_capoluogo',
                        'multi_cap',
                        'cap',
                        'cap_inizio',
                        'cap_fine',
                        'updated_at'
                    ]
                );
                $batch = []; // Svuoto il batch dopo aver scritto
            }
        }
        fclose($h); // Chiudo il file dopo aver finito di leggerlo

        if ($batch) { // Se mi sono rimasti record non ancora scritti
            DB::table('comuni')->upsert( // Faccio l'ultimo upsert con quello che resta
                $batch, // Passo le righe rimanenti
                ['codice_istat'], // Uso codice_istat come chiave di conflitto
                [ // Aggiorno le stesse colonne anche in questo upsert finale
                    'comune',
                    'regione',
                    'sigla_automobilistica',
                    'codice_belfiore',
                    'lat',
                    'lon',
                    'is_capoluogo',
                    'multi_cap',
                    'cap',
                    'cap_inizio',
                    'cap_fine',
                    'updated_at'
                ]
            );
        }
    }


    /**
     * Normalizzo l'header del CSV per poter cercare le colonne in modo consistente:
     * - metto tutto in minuscolo
     * - sostituisco spazi multipli con underscore
     * - faccio trim dei valori
     *
     * @param array<int, string>|null $header Header letto da fgetcsv (può essere null)
     * @return array<int, string> Header normalizzato
     */
    private function normalizeHeader(?array $header): array
    {
        $header = $header ?? []; // Se l'header è null, lo trasformo in array vuoto
        return array_map( // Applico una trasformazione a ogni colonna dell'header
            fn($h) => trim(mb_strtolower(preg_replace('/\s+/', '_', (string)$h))), // Converto in stringa, sostituisco spazi con _, metto in minuscolo e faccio trim
            $header // Uso l'header originale come input della mappatura
        ); // Ritorno l'array di colonne normalizzate
    }

    /**
     * Converto un valore testuale in float gestendo anche la virgola come separatore decimale.
     * Se il valore è nullo o vuoto ritorno null.
     *
     * @param mixed $val Valore da convertire (string/numero/null)
     * @return float|null Valore convertito oppure null se non valido
     */
    private function toDecimal($val): ?float
    {
        if ($val === null) return null; // Se il valore è null, non posso convertirlo e ritorno null
        $s = trim((string)$val); // Converto in stringa e tolgo spazi ai bordi
        if ($s === '') return null; // Se dopo il trim è vuoto, lo considero non valido
        $s = str_replace(',', '.', $s); // Sostituisco la virgola con il punto per il formato decimale standard
        return (float) $s; // Converto la stringa in float e la ritorno
    }

    /**
     * Normalizzo un CAP estraendo solo le cifre e limitandolo a 5 caratteri.
     * Se non trovo cifre, ritorno null.
     *
     * @param mixed $val Valore di input del CAP (string/numero/null)
     * @return string|null CAP normalizzato a 5 cifre oppure null se non valido
     */
    private function normalizeCap($val): ?string
    {
        if ($val === null) return null; // Se il valore è null, non posso ottenere un CAP e ritorno null
        $s = preg_replace('/\D/', '', (string)$val); // Tengo solo le cifre rimuovendo qualsiasi carattere non numerico
        if ($s === '') return null; // Se non rimangono cifre, il CAP non è valido
        return substr($s, 0, 5); // Ritorno solo le prime 5 cifre (formato CAP standard)
    }
}
