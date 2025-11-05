<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\CategoriaModel;
use App\Models\CategoriaFilmModel;
use App\Models\FilmModel;

class CategoriaFilmSeeder extends Seeder
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

        // 2) Ricostruisci l’ordine unico degli slug film dal JSON
        $uniqueSlugs = [];
        foreach ($data as $sezione) {
            foreach (($sezione['posters'] ?? []) as $p) {
                if (($p['tipo'] ?? null) !== 'film') continue;
                $slug = $p['videoId'] ?? null;
                if ($slug && !isset($uniqueSlugs[$slug])) {
                    $uniqueSlugs[$slug] = true;
                }
            }
        }
        $uniqueSlugs = array_keys($uniqueSlugs); // array di slug in ordine

        // 3) Prendi i film inseriti (ordinati per id_film asc) e mappa slug -> id_film per indice
        $filmRows = FilmModel::orderBy('id_film', 'asc')->get(['id_film']);
        $slugToId = [];
        $count = min(count($uniqueSlugs), $filmRows->count());
        for ($i = 0; $i < $count; $i++) {
            $slugToId[$uniqueSlugs[$i]] = $filmRows[$i]->id_film;
        }

        // 4) Per OGNI OCCORRENZA 'film' nel JSON, inserisci (categoria, film) nella pivot
        foreach ($data as $sezione) {
            $codiceCategoria = $sezione['category'] ?? null;
            $idCategoria = $codiceCategoria && isset($catMap[$codiceCategoria]) ? $catMap[$codiceCategoria] : null;
            if (!$idCategoria) continue;

            foreach (($sezione['posters'] ?? []) as $p) {
                if (($p['tipo'] ?? null) !== 'film') continue;

                $slug = $p['videoId'] ?? null;
                if (!$slug || !isset($slugToId[$slug])) continue;

                $idFilm = $slugToId[$slug];

                // Evita duplicati grazie alla unique della pivot (o usa firstOrCreate)
                CategoriaFilmModel::firstOrCreate([
                    'id_categoria' => $idCategoria,
                    'id_film'      => $idFilm,
                ]);
            }
        }
    }
}
