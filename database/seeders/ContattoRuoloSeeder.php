<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContattoRuoloSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('contatti_ruoli')->insert([
            ['id_contatto' => 1, 'id_ruolo' => 1],
            ['id_contatto' => 1, 'id_ruolo' => 2],
            ['id_contatto' => 2, 'id_ruolo' => 2],
        ]);
    }
}
