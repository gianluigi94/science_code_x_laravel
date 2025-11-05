<?php
// database/seeders/ValutaSeeder.php

namespace Database\Seeders;

use App\Models\ValutaModel;
use Illuminate\Database\Seeder;

class ValutaSeeder extends Seeder
{
    public function run(): void
    {
        $paths = [
            storage_path('app/json_db/valute_europee.json'),
            storage_path('app/json_db/valute.json'),
        ];

        $items = [];
        foreach ($paths as $p) {
            if (file_exists($p)) {
                $decoded = json_decode(file_get_contents($p), true) ?: [];
                $items = array_merge($items, $decoded);
            }
        }

        foreach ($items as $v) {
            ValutaModel::updateOrCreate(
                ['codice_iso' => $v['codice_iso']],
                [
                    'nome'     => $v['nome'],
                    'simbolo'  => $v['simbolo'],
                    'decimali' => (int) $v['decimali'],
                ]
            );
        }
    }
}
