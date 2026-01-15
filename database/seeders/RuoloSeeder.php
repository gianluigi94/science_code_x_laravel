<?php

namespace Database\Seeders;

use App\Models\RuoloModel;
use Illuminate\Database\Seeder;

class RuoloSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        RuoloModel::create(['ruolo' => 'ospite']);
        RuoloModel::create(['ruolo' => 'utente_base']);
        RuoloModel::create(['ruolo' => 'utente_premium']);
        RuoloModel::create(['ruolo' => 'amministratore_contenuti']);
        RuoloModel::create(['ruolo' => 'amministratore_pubblicitario']);
        RuoloModel::create(['ruolo' => 'amministratore_analitico']);
        RuoloModel::create(['ruolo' => 'amministratore_principale']);
    }
}
