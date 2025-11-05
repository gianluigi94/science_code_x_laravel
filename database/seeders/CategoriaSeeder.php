<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaModel;
use Illuminate\Support\Facades\Storage;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file JSON
        $path = storage_path('app/json_db/it.json');

        // Legge il file e decodifica il contenuto
        $json = json_decode(file_get_contents($path), true);

        // Estrae la sezione "CATEGORIA"
        $categorie = $json['CATEGORIA'] ?? [];

        // Elimina le prime tre chiavi che non devono essere inserite
        unset($categorie['continua_a_guardare']);
        unset($categorie['i_preferiti']);
        unset($categorie['i_piu_visti']);

        // Inserisce ciascuna categoria nel database
        foreach ($categorie as $codice => $label) {
            CategoriaModel::create(['codice' => $codice]);
        }
    }
}
