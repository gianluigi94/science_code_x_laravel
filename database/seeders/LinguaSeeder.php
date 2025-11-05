<?php

namespace Database\Seeders;

use App\Models\LinguaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinguaSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
