<?php

namespace Database\Seeders;

use App\Models\IndirizzoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndirizzoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IndirizzoModel::create([
            'id_contatto' => 1,
        'id_nazione' => 81,
        'id_comune' => 81,
        'cap' => '0007',
        'indirizzo' => 'Via Roma',
        'civico' => '5',
        'id_tipo_indirizzo' => 1
        ]);


        IndirizzoModel::create([
            'id_contatto' => 2,
        'id_nazione' => 20,
        'indirizzo' => 'Via Roma',
        'civico' => '5',
        'id_tipo_indirizzo' => 1

        ]);
        IndirizzoModel::create([
            'id_contatto' => 2,
        'id_nazione' => 20,
        'indirizzo' => 'Via Roma',
        'civico' => '5',
        'id_tipo_indirizzo' => 2

        ]);

    }
}
