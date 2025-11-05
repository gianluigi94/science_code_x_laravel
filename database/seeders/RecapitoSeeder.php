<?php

namespace Database\Seeders;

use App\Models\RecapitoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecapitoModel::create([
            'id_contatto' => 1,
            'id_tipo_recapito' => 1,
            'recapito' => 'email_esempio@yahoo.com'
        ]);
        RecapitoModel::create([
            'id_contatto' => 1,
            'id_tipo_recapito' => 2,
            'recapito' => '123456'
        ]);
        RecapitoModel::create([
            'id_contatto' => 2,
            'id_tipo_recapito' => 1,
            'recapito' => 'email_esempio@gmail.com'
        ]);
        RecapitoModel::create([
            'id_contatto' => 2,
            'id_tipo_recapito' => 2,
            'recapito' => '654321'
        ]);
    }
}
