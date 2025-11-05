<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\SerieModel;
use App\Models\RegistaModel;

class SerieSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/json_db/categorie.json');
        $data = json_decode(File::get($path), true);

        if (!is_array($data)) {
            return;
        }

        // Slug considerati come "novità"
        $novitaSlugs = [
            'cavalli_contro_circuiti',
            'il_mio_gatto_nella_scatola',
            'l_era_dell_alchimia',
            'rivelazioni_dalla_sonda_cassini',
            'rna_e_la_memoria_cellulare',
            'il_lungo_volo_del_coraggio',
        ];

        // Mappa rapida: nome regista → id_regista
        $registiMap = RegistaModel::pluck('id_regista', 'nome')->all();

        $giaInserite = [];

        foreach ($data as $sezione) {
            $posters = $sezione['posters'] ?? [];

            foreach ($posters as $p) {
                if (($p['tipo'] ?? null) !== 'serie') {
                    continue;
                }

                $slug = $p['videoId'] ?? null;
                if (!$slug || isset($giaInserite[$slug])) {
                    continue;
                }
                $giaInserite[$slug] = true;

                // Recupera il regista dal JSON e trova l'id corrispondente
                $registaNome = $p['regista'] ?? null;
                $idRegista = $registaNome && isset($registiMap[$registaNome])
                    ? $registiMap[$registaNome]
                    : 1; // fallback fittizio se non trovato

                $anno = isset($p['anno']) ? (int) $p['anno'] : 2000;
                $imgSfondo = $p['img_hero'] ?? 'placeholder.webp';

                // Descrizione dinamica
                $descrizione = 'serie.' . $slug;

                SerieModel::create([
                    'id_regista'      => $idRegista,
                    'anno'            => $anno,
                    'numero_stagioni' => 0,
                    'numero_episodi'  => 0,
                    'img_sfondo'      => $imgSfondo,
                    'novita'          => in_array($slug, $novitaSlugs, true),
                    'descrizione'     => $descrizione,
                ]);
            }
        }
    }
}
