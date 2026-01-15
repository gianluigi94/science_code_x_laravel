<?php

namespace Database\Seeders;

use App\Models\TipoRecapitoModel;
use Illuminate\Database\Seeder;

class TipoRecapitoSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        TipoRecapitoModel::create([
            'tipo' => 'email'
        ]);
        TipoRecapitoModel::create([
            'tipo' => 'telefono'
        ]);
    }
}
