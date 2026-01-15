<?php

namespace Database\Seeders;

use App\Models\LinguaModel;
use Illuminate\Database\Seeder;

class LinguaSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        LinguaModel::create([
            'codice' => 'it',
            'nome' => 'italiano',
        ]);
        LinguaModel::create([
            'codice' => 'en',
            'nome' => 'inglese',
        ]);
    }
}
