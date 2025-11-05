<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriaTraduzioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pathIt = storage_path('app/json_db/it.json');
        $pathEn = storage_path('app/json_db/en.json');

        $jsonIt = json_decode(File::get($pathIt), true);
        $jsonEn = json_decode(File::get($pathEn), true);

        $categorieIt = $jsonIt['CATEGORIA'];
        $categorieEn = $jsonEn['CATEGORIA'];

        // Rimuove le prime tre voci non desiderate
        unset($categorieIt['continua_a_guardare']);
        unset($categorieIt['i_preferiti']);
        unset($categorieIt['i_piu_visti']);
        unset($categorieEn['continua_a_guardare']);
        unset($categorieEn['i_preferiti']);
        unset($categorieEn['i_piu_visti']);

        $id = 1;
        $now = now();

        foreach ($categorieIt as $codice => $labelIt) {
            $labelEn = $categorieEn[$codice] ?? $labelIt;

            DB::table('categorie_traduzioni')->insert([
                [
                    'id_categoria' => $id,
                    'id_lingua'    => 1,
                    'nome'         => $labelIt,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ],
                [
                    'id_categoria' => $id,
                    'id_lingua'    => 2,
                    'nome'         => $labelEn,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ],
            ]);

            $id++;
        }
    }
}
