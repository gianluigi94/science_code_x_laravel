<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ComuneSeeder extends Seeder
{
    public function run(): void
    {
        // Percorsi (usiamo storage_path come nel tuo esempio)
        $pathA = storage_path('app/csv_db/gi_comuni_cap.csv'); // anagrafica + cap principale
        $pathB = storage_path('app/csv_db/gi_cap.csv');        // elenco (codice_istat;cap)

        // 1) Aggrega i CAP per codice_istat da gi_cap.csv
        $agg = $this->buildCapAggregation($pathB, ';');

        // 2) Legge l'anagrafica e inserisce nella tabella comuni
        $this->seedComuni($pathA, ';', $agg);
    }

    /**
     * Legge gi_cap.csv e costruisce:
     *   $agg[$istat] = ['n_cap' => n, 'cap_start' => min, 'cap_end' => max]
     */
    private function buildCapAggregation(string $file, string $sep): array
    {
        $capsByIstat = [];

        if (!is_readable($file)) {
            $this->command?->warn("File CAP non trovato o non leggibile: $file");
            return [];
        }

        $h = fopen($file, 'r');
        if (!$h) {
            $this->command?->warn("Impossibile aprire il file CAP: $file");
            return [];
        }

        // Legge header
        $header = fgetcsv($h, 0, $sep);
        $header = $this->normalizeHeader($header);

        $iIstat = array_search('codice_istat', $header, true);
        $iCap   = array_search('cap',           $header, true);

        if ($iIstat === false || $iCap === false) {
            fclose($h);
            $this->command?->warn("Header non atteso in gi_cap.csv: servono 'codice_istat' e 'cap'");
            return [];
        }

        while (($row = fgetcsv($h, 0, $sep)) !== false) {
            // salta righe vuote
            if (count($row) === 1 && trim($row[0]) === '') continue;

            $istat = trim((string)($row[$iIstat] ?? ''));
            $cap   = $this->normalizeCap($row[$iCap] ?? '');

            if ($istat === '' || $cap === null) continue;

            // set distinti
            $capsByIstat[$istat][$cap] = true;
        }
        fclose($h);

        // Aggregazione finale
        $agg = [];
        foreach ($capsByIstat as $istat => $set) {
            $caps = array_keys($set);
            sort($caps, SORT_STRING);
            $n = count($caps);
            $agg[$istat] = [
                'n_cap'     => $n,
                'cap_start' => $n ? $caps[0] : null,
                'cap_end'   => $n ? $caps[$n - 1] : null,
            ];
        }

        return $agg;
    }

    /**
     * Legge gi_comuni_cap.csv e inserisce i record nella tabella 'comuni'
     */
    private function seedComuni(string $file, string $sep, array $agg): void    {
        if (!is_readable($file)) {
            $this->command?->error("File anagrafica non trovato o non leggibile: $file");
            return;
        }

                // Pulisce la tabella evitando l’errore di FK con indirizzi.id_comune
        Schema::disableForeignKeyConstraints();
        DB::table('comuni')->truncate();
        Schema::enableForeignKeyConstraints();

        $h = fopen($file, 'r');
        if (!$h) {
            $this->command?->error("Impossibile aprire il file anagrafica: $file");
            return;
        }

        $header = fgetcsv($h, 0, $sep);
        $header = $this->normalizeHeader($header);

        // Mappatura indici (nomi presi dal tuo esempio di header)
        $iIstat     = array_search('codice_istat',           $header, true);
        $iComune    = array_search('denominazione_ita',      $header, true);
        if ($iComune === false) {
            // fallback: alcuni file usano 'denominazione' o 'denominazione_ita_altra'
            $iComune = array_search('denominazione', $header, true);
            if ($iComune === false) {
                $iComune = array_search('denominazione_ita_altra', $header, true);
            }
        }
        $iCapMain   = array_search('cap',                    $header, true);
        $iSigla     = array_search('sigla_provincia',        $header, true);
        $iRegione   = array_search('denominazione_regione',  $header, true);
        $iBelfiore  = array_search('codice_belfiore',        $header, true);
        $iLat       = array_search('lat',                    $header, true);
        $iLon       = array_search('lon',                    $header, true);
        $iFlagCap   = array_search('flag_capoluogo',         $header, true);

        $batch = [];
        $now = now();
        $seen = []; // <-- NEW: set per deduplicare per codice_istat

        while (($row = fgetcsv($h, 0, $sep)) !== false) {
            // salta righe vuote
            if (count($row) === 1 && trim($row[0]) === '') continue;

            $istat = trim((string)($row[$iIstat] ?? ''));
            if ($istat === '') continue;

                    // <-- NEW: se già inserito, salta
        if (isset($seen[$istat])) continue;
        $seen[$istat] = true;

            $comune   = trim((string)($row[$iComune] ?? ''));
            $regione  = trim((string)($row[$iRegione] ?? ''));
            $sigla    = strtoupper(trim((string)($row[$iSigla] ?? '')));
            $belfiore = strtoupper(trim((string)($row[$iBelfiore] ?? '')));

            // lat/lon con virgola decimale → punto
            $lat = $this->toDecimal($row[$iLat] ?? null);  // decimal(10,7)
            $lon = $this->toDecimal($row[$iLon] ?? null);

            // CAP principale dall'anagrafica (normalizzato a 5 cifre)
            $capMain = $this->normalizeCap($row[$iCapMain] ?? null);

            // Flag capoluogo (SI/NO → boolean)
            $flag = strtoupper(trim((string)($row[$iFlagCap] ?? '')));
            $isCapoluogo = in_array($flag, ['SI', 'SÌ', 'SI\'', 'YES', 'Y', '1'], true);

            // Meta CAP aggregati da gi_cap.csv
            $meta = $agg[$istat] ?? ['n_cap' => ($capMain ? 1 : 0), 'cap_start' => $capMain, 'cap_end' => $capMain];
            $multi = ($meta['n_cap'] ?? 0) > 1 ? 1 : 0;
            $capStart = $multi ? ($meta['cap_start'] ?? null) : null;
            $capEnd   = $multi ? ($meta['cap_end']   ?? null) : null;

                    // <-- NEW: se l’anagrafica non ha cap principale, usa il min come principale
        if (!$capMain && ($meta['cap_start'] ?? null)) {
            $capMain = $meta['cap_start'];
        }


            $batch[] = [
                // PK auto: id_comune
                'comune'               => $comune,
                'regione'              => $regione,
                'sigla_automobilistica'=> $sigla,
                'codice_belfiore'      => $belfiore,
                'lat'                  => $lat,
                'lon'                  => $lon,
                'is_capoluogo'         => $isCapoluogo ? 1 : 0,
                'multi_cap'            => $multi,
                'cap'                  => $capMain ?? '',
                'cap_inizio'           => $capStart,
                'cap_fine'             => $capEnd,
                'codice_istat'         => $istat,
                'created_at'           => $now,
                'updated_at'           => $now,
            ];

                    if (count($batch) === 1000) {
            DB::table('comuni')->upsert(
                $batch,
                ['codice_istat'], // chiave unica
                [
                    'comune','regione','sigla_automobilistica','codice_belfiore',
                    'lat','lon','is_capoluogo','multi_cap','cap','cap_inizio','cap_fine',
                    'updated_at'
                ]
            );
            $batch = [];
        }
        }
        fclose($h);

            if ($batch) {
        DB::table('comuni')->upsert(
            $batch,
            ['codice_istat'],
            [
                'comune','regione','sigla_automobilistica','codice_belfiore',
                'lat','lon','is_capoluogo','multi_cap','cap','cap_inizio','cap_fine',
                'updated_at'
            ]
        );
    }
    }

    private function normalizeHeader(?array $header): array
    {
        $header = $header ?? [];
        return array_map(
            fn($h) => trim(mb_strtolower(preg_replace('/\s+/', '_', (string)$h))),
            $header
        );
    }

    private function toDecimal($val): ?float
    {
        if ($val === null) return null;
        $s = trim((string)$val);
        if ($s === '') return null;
        // sostituisce solo la virgola decimale (niente regex per non toccare il separatore CSV)
        $s = str_replace(',', '.', $s);
        return (float) $s;
    }

    private function normalizeCap($val): ?string
    {
        if ($val === null) return null;
        $s = preg_replace('/\D/', '', (string)$val); // solo cifre
        if ($s === '') return null;
        // i CAP sono 5 cifre in Italia
        return substr($s, 0, 5);
    }
}
