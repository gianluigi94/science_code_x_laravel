<?php

namespace Database\Seeders;

use App\Models\TipoRecapitoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoRecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoRecapitoModel::create([
            'tipo' => 'email'
        ]);
        TipoRecapitoModel::create([
            'tipo' => 'telefono'
        ]);
    }
}
