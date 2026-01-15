<?php

namespace Database\Seeders;

use App\Models\NazioneModel;
use App\Models\ValutaModel;
use Illuminate\Database\Seeder;

class NazioneSeeder extends Seeder
{

    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $ids = ValutaModel::pluck('id_valuta', 'codice_iso')->toArray(); // creo una mappa codice_valuta => id_valuta
        $usdId = $ids['USD'] ?? null; // salvo l'id della valuta USD come fallback generale
        $eurId = $ids['EUR'] ?? null; // salvo l'id della valuta EUR

        $csv = storage_path("app/csv_db/nazioni.csv"); // Mi costruisco il percorso del CSV delle nazioni
        $file = fopen($csv, "r"); // Apro il file CSV in lettura

        while (($data = fgetcsv($file, 197, ",")) !== false) { // Scorro tutte le righe del CSV
            $iso = $data[4]; // Estraggo il codice ISO a 2 lettere della nazione
            $valuta_id = $usdId; // Imposto di default USD come valuta (fallback)

            // Gestisco i paesi che adottano l'EURO (inclusi microstati e casi particolari)
            $euro_iso = [
                'IT',
                'FR',
                'DE',
                'ES',
                'PT',
                'NL',
                'BE',
                'AT',
                'FI',
                'IE',
                'GR',
                'CY',
                'MT',
                'LU',
                'SI',
                'SK',
                'LV',
                'EE',
                'LT',
                'HR',
                'SM',
                'AD',
                'MC',
                'VA',
                'XK'
            ];
            if (in_array($iso, $euro_iso, true)) {
                $valuta_id = $eurId;
            }

            // Per gli altri paesi associo la valuta specifica, se presente, altrimenti USD
            elseif ($iso === 'US') $valuta_id = $ids['USD'] ?? $usdId;
            elseif ($iso === 'JP') $valuta_id = $ids['JPY'] ?? $usdId;
            elseif ($iso === 'BG') $valuta_id = $ids['BGN'] ?? $usdId;
            elseif ($iso === 'CZ') $valuta_id = $ids['CZK'] ?? $usdId;
            elseif ($iso === 'DK') $valuta_id = $ids['DKK'] ?? $usdId;
            elseif ($iso === 'GB') $valuta_id = $ids['GBP'] ?? $usdId;
            elseif ($iso === 'HU') $valuta_id = $ids['HUF'] ?? $usdId;
            elseif ($iso === 'PL') $valuta_id = $ids['PLN'] ?? $usdId;
            elseif ($iso === 'RO') $valuta_id = $ids['RON'] ?? $usdId;
            elseif ($iso === 'SE') $valuta_id = $ids['SEK'] ?? $usdId;
            elseif ($iso === 'CH') $valuta_id = $ids['CHF'] ?? $usdId;
            elseif ($iso === 'IS') $valuta_id = $ids['ISK'] ?? $usdId;
            elseif ($iso === 'NO') $valuta_id = $ids['NOK'] ?? $usdId;
            elseif ($iso === 'TR') $valuta_id = $ids['TRY'] ?? $usdId;
            elseif ($iso === 'AU') $valuta_id = $ids['AUD'] ?? $usdId;
            elseif ($iso === 'BR') $valuta_id = $ids['BRL'] ?? $usdId;
            elseif ($iso === 'CA') $valuta_id = $ids['CAD'] ?? $usdId;
            elseif ($iso === 'CN') $valuta_id = $ids['CNY'] ?? $usdId;
            elseif ($iso === 'HK') $valuta_id = $ids['HKD'] ?? $usdId;
            elseif ($iso === 'ID') $valuta_id = $ids['IDR'] ?? $usdId;
            elseif ($iso === 'IL') $valuta_id = $ids['ILS'] ?? $usdId;
            elseif ($iso === 'IN') $valuta_id = $ids['INR'] ?? $usdId;
            elseif ($iso === 'KR') $valuta_id = $ids['KRW'] ?? $usdId;
            elseif ($iso === 'MX') $valuta_id = $ids['MXN'] ?? $usdId;
            elseif ($iso === 'MY') $valuta_id = $ids['MYR'] ?? $usdId;
            elseif ($iso === 'NZ') $valuta_id = $ids['NZD'] ?? $usdId;
            elseif ($iso === 'PH') $valuta_id = $ids['PHP'] ?? $usdId;
            elseif ($iso === 'SG') $valuta_id = $ids['SGD'] ?? $usdId;
            elseif ($iso === 'TH') $valuta_id = $ids['THB'] ?? $usdId;
            elseif ($iso === 'ZA') $valuta_id = $ids['ZAR'] ?? $usdId;

            // Inserisco la nazione nel database con i dati letti dal CSV e la valuta determinata
            NazioneModel::create([
                "id_nazione"   => $data[0],
                "nazione_it"   => $data[1],
                "nazione_en"   => $data[2],
                "continente"   => $data[3],
                "iso"          => $data[4],
                "iso3"         => $data[5],
                "prefisso_tel" => $data[6],
                "id_valuta"    => $valuta_id
            ]);
        }

        fclose($file); // Chiudo il file CSV dopo aver terminato la lettura
    }
}
