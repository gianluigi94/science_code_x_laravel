<?php

namespace Database\Seeders;

use App\Models\AutenticazioneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutenticazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AutenticazioneModel::create([
            'id_autenticazione' => 1,
            'id_contatto' => 1,
            'user' => hash('sha512', 'gian94'),
        ]);
        AutenticazioneModel::create([
            'id_autenticazione' => 2,
            'id_contatto' => 2,
            'user' => hash('sha512', 'annarossi27'),
        ]);

    }
}
