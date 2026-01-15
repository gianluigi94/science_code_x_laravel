<?php

namespace Database\Seeders;

use App\Models\StatoUtenteModel;
use Illuminate\Database\Seeder;

class StatoUtenteSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        StatoUtenteModel::create([
            'id_stato_utente' => 1,
            'stato' => 'attivo',
        ]);
        StatoUtentemodel::create([
            'id_stato_utente' => 2,
            'stato' => 'bannato',
        ]);
    }
}
