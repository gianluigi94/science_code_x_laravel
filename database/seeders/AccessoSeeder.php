<?php

namespace Database\Seeders;

use App\Models\AccessoModel;
use Illuminate\Database\Seeder;

class AccessoSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        AccessoModel::create([
            'id_contatto'     => 1,
            'indirizzo_ip'  => '192.168.1.10',
            'successo'      => false, // fallito
        ]);

        AccessoModel::create([
            'id_contatto'     => 1,
            'indirizzo_ip'  => '192.168.1.10',
            'successo'      => true, // riuscito
        ]);

        AccessoModel::create([
            'id_contatto'     => 2,
            'indirizzo_ip'  => '192.168.1.11',
            'successo'      => true, // riuscito
        ]);
    }
}
