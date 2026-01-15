<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\CategoriaModel;
use App\Models\CategoriaSerieModel;
use App\Models\SerieModel;

class CategoriaSerieSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json'); // Mi costruisco il percorso del file JSON con le categorie
        $data = json_decode(File::get($path), true); // Leggo il file e lo decodifico in array associativo

        if (!is_array($data)) { // Controllo che il JSON sia valido e sia diventato un array
            return; // Se non lo è, esco senza fare niente
        }

        $catMap = CategoriaModel::pluck('id_categoria', 'codice')->all(); // Mi creo una mappa codice_categoria => id_categoria dal DB

        $uniqueSlugs = []; // Inizializzo un "set" per raccogliere gli slug (videoId) delle serie senza duplicati
        foreach ($data as $sezione) { // Scorro ogni sezione del JSON (tipicamente una categoria)
            foreach (($sezione['posters'] ?? []) as $p) { // Scorro i poster della sezione (se non ci sono uso array vuoto)
                if (($p['tipo'] ?? null) !== 'serie') continue; // Se non è una serie, la salto
                $slug = $p['videoId'] ?? null; // Prendo lo slug della serie dal campo videoId
                if ($slug && !isset($uniqueSlugs[$slug])) { // Se lo slug esiste e non l'ho ancora inserito
                    $uniqueSlugs[$slug] = true; // Lo segno come presente per mantenerlo univoco
                }
            }
        }
        $uniqueSlugs = array_keys($uniqueSlugs); // Trasformo il "set" in una lista di slug unici

        $serieRows = SerieModel::orderBy('id_serie', 'asc')->get(['id_serie']); // Recupero tutti gli id delle serie dal DB in ordine crescente
        $slugToId = []; // Preparo una mappa slug => id_serie
        $count = min(count($uniqueSlugs), $serieRows->count()); // Calcolo quante associazioni posso fare senza sforare
        for ($i = 0; $i < $count; $i++) { // Scorro gli indici fino al massimo possibile
            $slugToId[$uniqueSlugs[$i]] = $serieRows[$i]->id_serie; // Associo lo slug i-esimo all'id_serie i-esimo
        }

        foreach ($data as $sezione) { // Riscorro le sezioni per creare le relazioni categoria-serie
            $codiceCategoria = $sezione['category'] ?? null; // Mi prendo il codice categoria della sezione
            $idCategoria = $codiceCategoria && isset($catMap[$codiceCategoria]) ? $catMap[$codiceCategoria] : null; // Converto il codice nell'id categoria
            if (!$idCategoria) continue; // Se la categoria non esiste nel DB, salto

            foreach (($sezione['posters'] ?? []) as $p) { // Scorro i poster della sezione
                if (($p['tipo'] ?? null) !== 'serie') continue; // Se non è una serie, la salto

                $slug = $p['videoId'] ?? null; // Prendo lo slug della serie
                if (!$slug || !isset($slugToId[$slug])) continue; // Se non ho lo slug o non ho la mappatura, salto

                $idSerie = $slugToId[$slug]; // Ricavo l'id della serie corrispondente allo slug

                CategoriaSerieModel::firstOrCreate([ // Creo la relazione solo se non esiste già
                    'id_categoria' => $idCategoria,
                    'id_serie'     => $idSerie,
                ]);
            }
        }
    }
}
