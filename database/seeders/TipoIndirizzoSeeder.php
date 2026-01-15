<?php

namespace Database\Seeders;

use App\Models\TipoIndirizzoModel;
use Illuminate\Database\Seeder;

class TipoIndirizzoSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        TipoIndirizzoModel::create([
            'tipo' => 'residenziale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'sede legale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'aziendale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'residenza_estiva'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'fatturazione'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'altro'
        ]);
    }
}
