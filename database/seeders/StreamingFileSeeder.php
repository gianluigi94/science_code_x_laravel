<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StreamingFileModel;

class StreamingFileSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = storage_path('app/json_db/it.json'); // Mi costruisco il percorso del JSON italiano
        $json = json_decode(file_get_contents($path), true); // Leggo il file e lo decodifico in array associativo

        $videos = $json['VIDEO'] ?? []; // Mi prendo la sezione VIDEO dal JSON (se manca uso array vuoto)

        foreach ($videos as $slug => $item) { // Scorro tutti i contenuti indicizzati per slug
            if (isset($item['serie']) && is_array($item['serie'])) { // Se trovo la chiave "serie", capisco che è una serie con stagioni/episodi
                foreach ($item['serie'] as $stagione => $episodi) { // Scorro le stagioni della serie
                    foreach ($episodi as $episodio => $datiEp) { // Scorro gli episodi della stagione
                        if (!isset($datiEp['video']) || !is_array($datiEp['video'])) { // Controllo che ci sia il blocco "video" dell'episodio
                            continue; // Se non c'è, salto l'episodio
                        }
                        $v = $datiEp['video']; // Mi salvo il blocco video dell'episodio (auto/1080/720/360)

                        StreamingFileModel::create([ // Inserisco una riga streaming per l'episodio
                            'descrizione' => "serie.$slug.s{$stagione}.e{$episodio}", // Mi creo la descrizione tecnica dell'episodio
                            'url_auto'    => $v['auto']  ?? null,
                            'url_1080'    => $v['1080']  ?? null,
                            'url_720'     => $v['720']   ?? null,
                            'url_360'     => $v['360']   ?? null,
                        ]);
                    }
                }
                continue; // Dopo aver gestito la serie, passo al contenuto successivo
            }

            if (isset($item['video']) && is_array($item['video'])) { // Se invece ho un blocco "video" diretto, capisco che è un film
                $v = $item['video']; // Mi salvo il blocco video del film (auto/1080/720/360)

                StreamingFileModel::create([ // Inserisco una riga streaming per il film
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
