<?php

namespace Database\Seeders;

use App\Models\ConfigurazioneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            ConfigurazioneModel::create([
                'chiave' => 'max_login_errati',
                'valore' => 5,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'durata_sfida',
                'valore' => 30,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'durata_sessione_standard',
                'valore' => 3600,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'storico_psw',
                'valore' => 3,
            ]);

            ConfigurazioneModel::create([
                'chiave' => 'termina_tk_standard',
                'valore' => 3610,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'termina_tk_collegato',
                'valore' => 2592010,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'termina_sessione_idle',
                'valore' => 172800,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'termina_sessione_assoluta',
                'valore' => 2592000,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'termina_psw',
                'valore' => 15552000,
            ]);
            ConfigurazioneModel::create([
                'chiave' => 'blocco_psw',
                'valore' => 7200,
            ]);
    }
}
