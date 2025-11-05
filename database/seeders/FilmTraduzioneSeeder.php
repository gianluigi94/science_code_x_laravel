<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\FilmModel;
use App\Models\LinguaModel;
use App\Models\FilmTraduzioneModel;

class FilmTraduzioneSeeder extends Seeder
{
    public function run(): void
    {
        $it = LinguaModel::firstOrCreate(['codice' => 'it'], ['nome' => 'italiano']);
        $en = LinguaModel::firstOrCreate(['codice' => 'en'], ['nome' => 'inglese']);

        $lingue = [
            ['id' => (int) ($it->id_lingua ?? $it->id), 'data' => $this->loadJson('it')],
            ['id' => (int) ($en->id_lingua ?? $en->id), 'data' => $this->loadJson('en')],
        ];

        foreach (FilmModel::all() as $film) {
            $slug = preg_replace('/^film\./i', '', trim((string) $film->descrizione));
            if ($slug === '') continue;

            foreach ($lingue as $meta) {
                $video = $meta['data']['VIDEO'] ?? $meta['data']['video'] ?? [];
                $entry = $video[$slug] ?? null;
                if (!$entry) continue;

                FilmTraduzioneModel::updateOrCreate(
                    ['id_film' => $film->id_film, 'id_lingua' => $meta['id']],
                    [
                        'titolo'        => $entry['img_titolo']    ?? $entry['img_title']   ?? null,
                        'sottotitolo'   => $entry['sottotitolo']   ?? $entry['subtitle']    ?? null,
                        'trailer'       => $entry['video_trailer'] ?? $entry['trailer']     ?? null,
                        'descrizione'   => $entry['intro']         ?? $entry['descrizione'] ?? null,
                        'img_locandina' => $entry['locandina']     ?? $entry['poster']      ?? null,
                    ]
                );
            }
        }
    }

    protected function loadJson(string $lang): array
    {
        $path = storage_path("app/json_db/{$lang}.json");
        if (!File::exists($path)) return [];
        $data = json_decode(File::get($path), true);
        return is_array($data) ? $data : [];
    }
}
