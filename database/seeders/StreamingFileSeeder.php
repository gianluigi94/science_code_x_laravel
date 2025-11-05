<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StreamingFileModel;

class StreamingFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/json_db/it.json');
        $json = json_decode(file_get_contents($path), true);

        $videos = $json['VIDEO'] ?? [];

        foreach ($videos as $slug => $item) {
            // Serie: ha più set di tracce per stagioni/episodi
            if (isset($item['serie']) && is_array($item['serie'])) {
                foreach ($item['serie'] as $stagione => $episodi) {
                    foreach ($episodi as $episodio => $datiEp) {
                        if (!isset($datiEp['video']) || !is_array($datiEp['video'])) {
                            continue;
                        }
                        $v = $datiEp['video'];

                        StreamingFileModel::create([
                            'descrizione' => "serie.$slug.s{$stagione}.e{$episodio}",
                            'url_auto'    => $v['auto']  ?? null,
                            'url_1080'    => $v['1080']  ?? null,
                            'url_720'     => $v['720']   ?? null,
                            'url_360'     => $v['360']   ?? null,
                        ]);
                    }
                }
                continue;
            }

            // Film: un solo set di tracce
            if (isset($item['video']) && is_array($item['video'])) {
                $v = $item['video'];

                StreamingFileModel::create([
                    'descrizione' => "film.$slug",
                    'url_auto'    => $v['auto']  ?? null,
                    'url_1080'    => $v['1080']  ?? null,
                    'url_720'     => $v['720']   ?? null,
                    'url_360'     => $v['360']   ?? null,
                ]);
            }
        }
    }
}
