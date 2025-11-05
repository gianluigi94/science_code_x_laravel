<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContattoRuoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('contatti_ruoli')->insert([
            ['id_contatto' => 1, 'id_ruolo' => 1],
            ['id_contatto' => 1, 'id_ruolo' => 2],
            ['id_contatto' => 2, 'id_ruolo' => 2],
        ]);
    }
}
