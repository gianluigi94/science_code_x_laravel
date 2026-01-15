<?php

namespace Database\Seeders;

use App\Models\AliquotaModel;
use App\Models\NazioneModel;
use Illuminate\Database\Seeder;

class AliquotaSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $aliquote = [
            'AT' => 20.00,
            'BE' => 21.00,
            'BG' => 20.00,
            'CY' => 19.00,
            'CZ' => 21.00,
            'DE' => 19.00,
            'DK' => 25.00,
            'EE' => 24.00,
            'EL' => 24.00,
            'ES' => 21.00,
            'FI' => 25.50,
            'FR' => 20.00,
            'HR' => 25.00,
            'HU' => 27.00,
            'IE' => 23.00,
            'IT' => 22.00,
            'LT' => 21.00,
            'LU' => 17.00,
            'LV' => 21.00,
            'MT' => 18.00,
            'NL' => 21.00,
            'PL' => 23.00,
            'PT' => 23.00,
            'RO' => 21.00,
            'SE' => 25.00,
            'SI' => 22.00,
            'SK' => 23.00,
        ];
        // Scorre l'elenco ISO => aliquota: per ogni codice ISO cerca l'id della nazione in tabella `nazioni`
        //  Se la nazione esiste, crea l'aliquota se non presente oppure la aggiorna se già esiste
        foreach ($aliquote as $iso => $percentuale) {
            $idNazione = NazioneModel::where('iso', $iso)->value('id_nazione');
            if ($idNazione) {
                AliquotaModel::updateOrCreate(
                    ['id_nazione' => $idNazione],
                    ['aliquota' => $percentuale]
                );
            }
        }
    }
}
