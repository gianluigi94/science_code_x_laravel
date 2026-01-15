<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PasswordModel;

class PasswordSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        PasswordModel::create([
            'id_contatto' => 1,
            'password' => hash('sha512', 'cAnemagico1*')
        ]);
        PasswordModel::create([
            'id_contatto' => 2,
            'password' => hash('sha512', 'gAttomagico1*')

        ]);
    }
}
