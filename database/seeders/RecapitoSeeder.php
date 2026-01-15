<?php

namespace Database\Seeders;

use App\Models\RecapitoModel;
use Illuminate\Database\Seeder;

class RecapitoSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        RecapitoModel::create([
            'id_contatto' => 1,
            'id_tipo_recapito' => 1,
            'recapito' => 'email_esempio@yahoo.com'
        ]);
        RecapitoModel::create([
            'id_contatto' => 1,
            'id_tipo_recapito' => 2,
            'recapito' => '123456'
        ]);
        RecapitoModel::create([
            'id_contatto' => 2,
            'id_tipo_recapito' => 1,
            'recapito' => 'email_esempio@gmail.com'
        ]);
        RecapitoModel::create([
            'id_contatto' => 2,
            'id_tipo_recapito' => 2,
            'recapito' => '654321'
        ]);
    }
}
