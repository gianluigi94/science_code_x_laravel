<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContattoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContattoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContattoModel::create([
            'nome' => 'Luca',
            'cognome' => 'Rossi',
            'sesso' => 0,
            'codice_fiscale' => 'RSSMRA80A01F205X',
            'data_nascita' => '1980-01-01',
            'id_stato_utente' => 1,

        ]);

        ContattoModel::create([
            'nome' => 'Laura',
            'cognome' => 'Bianchi',
            'sesso' => 1,
            'codice_fiscale' => 'BNCLRA85C41H501Y',
            'data_nascita' => '1985-03-01',
            'id_stato_utente' => 2,

        ]);
    }
}
