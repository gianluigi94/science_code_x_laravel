<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\EpisodioModel;
use App\Models\LinguaModel;
use App\Models\EpisodioTraduzioneModel;

class EpisodioTraduzioneSeeder extends Seeder
{
    public function run(): void
    {
        $it = LinguaModel::firstOrCreate(['codice' => 'it'], ['nome' => 'italiano']);
        $en = LinguaModel::firstOrCreate(['codice' => 'en'], ['nome' => 'inglese']);

        $lingue = [
            ['id' => (int) ($it->id_lingua ?? $it->id), 'data' => $this->loadJson('it')],
            ['id' => (int) ($en->id_lingua ?? $en->id), 'data' => $this->loadJson('en')],
        ];

        foreach (EpisodioModel::all() as $ep) {
            $desc = trim((string) $ep->descrizione);
            if (!preg_match('/^serie\.([^.]+)\.s(\d+)\.e(\d+)/i', $desc, $m)) continue;

            $slug = $m[1];
            $stagione = (string) ((int) $m[2]);
            $episodio = (string) ((int) $m[3]);

            foreach ($lingue as $meta) {
                $video = $meta['data']['VIDEO'] ?? $meta['data']['video'] ?? [];
                $entry = $video[$slug]['serie'][$stagione][$episodio] ?? null;
                if (!$entry) continue;

                EpisodioTraduzioneModel::updateOrCreate(
                    ['id_episodio' => $ep->id_episodio ?? $ep->id, 'id_lingua' => $meta['id']],
                    [
                        'titolo'      => $entry['titolo'] ?? null,
                        'descrizione' => $entry['descrizione'] ?? null,
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
