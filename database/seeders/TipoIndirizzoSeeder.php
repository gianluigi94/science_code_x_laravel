<?php

namespace Database\Seeders;

use App\Models\TipoIndirizzoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIndirizzoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoIndirizzoModel::create([
            'tipo' => 'residenziale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'sede legale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'aziendale'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'residenza_estiva'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'fatturazione'
        ]);
        TipoIndirizzoModel::create([
            'tipo' => 'altro'
        ]);
    }
}
