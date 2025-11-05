<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FilmModel;
use App\Models\EpisodioModel;
use App\Models\StreamingFileModel;
use Symfony\Component\Process\Process;

class DurataVideoSeeder extends Seeder
{
    public function run(): void
    {
        // Mappa streaming per lookup rapido
        $streaming = StreamingFileModel::get(['id_streaming_file','descrizione','url_auto']);
        $byId   = $streaming->keyBy('id_streaming_file');
        $byDesc = $streaming->keyBy('descrizione');

        // FILM
        $films = FilmModel::query()
            ->whereNotNull('id_streaming_file')
            ->get(['id_film','durata','id_streaming_file']);

        foreach ($films as $film) {
            $sf = $byId->get($film->id_streaming_file);
            if (!$sf || empty($sf->url_auto)) continue;

            $seconds = $this->probeSeconds($sf->url_auto);
            if (!is_int($seconds) || $seconds <= 0) continue;

            $curr = (int) ($film->getAttribute('durata') ?? 0);
            if ($curr !== $seconds) {
                $film->setAttribute('durata', $seconds);
                $film->save();
            }
        }

        // EPISODI
        $episodes = EpisodioModel::query()
            ->get(['id_episodio','durata','id_streaming_file','descrizione']);

        foreach ($episodes as $ep) {
            $sf = $ep->id_streaming_file ? $byId->get($ep->id_streaming_file) : null;
            if (!$sf && $ep->descrizione) $sf = $byDesc->get($ep->descrizione);
            if (!$sf || empty($sf->url_auto)) continue;

            $seconds = $this->probeSeconds($sf->url_auto);
            if (!is_int($seconds) || $seconds <= 0) continue;

            $curr = (int) ($ep->getAttribute('durata') ?? 0);
            if ($curr !== $seconds) {
                $ep->setAttribute('durata', $seconds);
                $ep->save();
            }
        }
    }

    private function probeSeconds(string $url): ?int
    {
        $bin = env('FFPROBE_BIN', 'ffprobe');
        $cmd = [
            $bin, '-v', 'error',
            '-show_entries', 'format=duration',
            '-of', 'default=noprint_wrappers=1:nokey=1',
            $url,
        ];

        $p = new Process($cmd);
        $p->setTimeout(30);
        $p->run();

        if (!$p->isSuccessful()) return null;

        $out = trim($p->getOutput());
        if ($out === '' || !is_numeric($out)) return null;

        $sec = (float) $out;
        return ($sec > 0 && is_finite($sec)) ? (int) round($sec) : null;
    }
}
