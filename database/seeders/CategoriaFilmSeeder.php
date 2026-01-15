<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\CategoriaModel;
use App\Models\CategoriaFilmModel;
use App\Models\FilmModel;

class CategoriaFilmSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json'); // Mi costruisco il percorso del file JSON con le categorie
        $data = json_decode(File::get($path), true); // Leggo il file e lo trasformo in un array PHP

        if (!is_array($data)) { // Controllo che il JSON sia stato decodificato correttamente come array
            return; // Se non lo è esco
        }

        $catMap = CategoriaModel::pluck('id_categoria', 'codice')->all(); // Mi creo una mappa codice_categoria => id_categoria dal DB

        $uniqueSlugs = []; // Inizializzo un array per raccogliere gli slug (videoId) dei film senza duplicati
        foreach ($data as $sezione) { // Scorro ogni sezione del JSON (una sezione per categoria)
            foreach (($sezione['posters'] ?? []) as $p) { // Scorro i poster della sezione (se non esistono uso array vuoto)
                if (($p['tipo'] ?? null) !== 'film') continue; // Se il poster non è un film, lo salto
                $slug = $p['videoId'] ?? null; // Mi prendo lo slug del film dal campo videoId
                if ($slug && !isset($uniqueSlugs[$slug])) { // Se lo slug esiste e non l'ho ancora visto
                    $uniqueSlugs[$slug] = true; // Lo segno come presente per renderlo univoco
                }
            }
        }
        $uniqueSlugs = array_keys($uniqueSlugs); // Converto l'array "set" in una lista di slug unici

        $filmRows = FilmModel::orderBy('id_film', 'asc')->get(['id_film']); // Prendo tutti gli id dei film dal DB in ordine crescente
        $slugToId = []; // Preparo una mappa slug => id_film
        $count = min(count($uniqueSlugs), $filmRows->count()); // Calcolo quante associazioni posso fare senza andare fuori indice
        for ($i = 0; $i < $count; $i++) { // Scorro gli indici fino al numero massimo possibile
            $slugToId[$uniqueSlugs[$i]] = $filmRows[$i]->id_film; // Associo lo slug i-esimo all'id_film i-esimo
        }

        foreach ($data as $sezione) { // Riscorro le sezioni del JSON per creare le relazioni categoria-film
            $codiceCategoria = $sezione['category'] ?? null; // Mi prendo il codice della categoria dalla sezione
            $idCategoria = $codiceCategoria && isset($catMap[$codiceCategoria]) ? $catMap[$codiceCategoria] : null; // Traduco il codice nel relativo id_categoria
            if (!$idCategoria) continue; // Se non trovo la categoria nel DB, salto la sezione

            foreach (($sezione['posters'] ?? []) as $p) { // Scorro i poster della sezione
                if (($p['tipo'] ?? null) !== 'film') continue; // Se non è un film, lo salto

                $slug = $p['videoId'] ?? null; // Mi riprendo lo slug del film
                if (!$slug || !isset($slugToId[$slug])) continue; // Se lo slug non c'è o non è mappato a un film, salto

                $idFilm = $slugToId[$slug]; // Ricavo l'id del film a partire dallo slug

                CategoriaFilmModel::firstOrCreate([ // Creo la relazione categoria-film solo se non esiste già
                    'id_categoria' => $idCategoria, // Imposto la categoria
                    'id_film'      => $idFilm, // Imposto il film
                ]);
            }
        }
    }
}
