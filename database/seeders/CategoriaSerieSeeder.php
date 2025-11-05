<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\CategoriaModel;
use App\Models\CategoriaSerieModel;
use App\Models\SerieModel;

class CategoriaSerieSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json');
        $data = json_decode(File::get($path), true);

        if (!is_array($data)) {
            return;
        }

        // 1) Mappa codice categoria -> id_categoria
        $catMap = CategoriaModel::pluck('id_categoria', 'codice')->all();

        // 2) Ricostruisci l’ordine unico degli slug serie dal JSON (stesso del SerieSeeder)
        $uniqueSlugs = [];
        foreach ($data as $sezione) {
            foreach (($sezione['posters'] ?? []) as $p) {
                if (($p['tipo'] ?? null) !== 'serie') continue;
                $slug = $p['videoId'] ?? null;
                if ($slug && !isset($uniqueSlugs[$slug])) {
                    $uniqueSlugs[$slug] = true;
                }
            }
        }
        $uniqueSlugs = array_keys($uniqueSlugs); // array di slug in ordine

        // 3) Prendi le serie inserite (ordinate per id_serie asc) e mappa slug -> id_serie per indice
        $serieRows = SerieModel::orderBy('id_serie', 'asc')->get(['id_serie']);
        $slugToId = [];
        $count = min(count($uniqueSlugs), $serieRows->count());
        for ($i = 0; $i < $count; $i++) {
            $slugToId[$uniqueSlugs[$i]] = $serieRows[$i]->id_serie;
        }

        // 4) Per OGNI OCCORRENZA 'serie' nel JSON, inserisci (categoria, serie) nella pivot
        foreach ($data as $sezione) {
            $codiceCategoria = $sezione['category'] ?? null;
            $idCategoria = $codiceCategoria && isset($catMap[$codiceCategoria]) ? $catMap[$codiceCategoria] : null;
            if (!$idCategoria) continue;

            foreach (($sezione['posters'] ?? []) as $p) {
                if (($p['tipo'] ?? null) !== 'serie') continue;

                $slug = $p['videoId'] ?? null;
                if (!$slug || !isset($slugToId[$slug])) continue;

                $idSerie = $slugToId[$slug];

                // Evita duplicati grazie alla unique della pivot (o usa firstOrCreate)
                CategoriaSerieModel::firstOrCreate([
                    'id_categoria' => $idCategoria,
                    'id_serie'     => $idSerie,
                ]);
            }
        }
    }
}
