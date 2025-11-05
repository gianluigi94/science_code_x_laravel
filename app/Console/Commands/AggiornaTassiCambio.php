<?php
// app/Console/Commands/AggiornaTassiCambio.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\ValutaModel;

class AggiornaTassiCambio extends Command
{
    protected $signature = 'aggiorna:tassi-cambio';
    protected $description = 'Scarica i tassi ECB (base EUR) e aggiorna tassi_cambio';

    public function handle()
    {
        $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        $res = Http::timeout(15)->get($url);
        if (!$res->ok()) {
            $this->error('Download fallito');
            return self::FAILURE;
        }

        $xml = simplexml_load_string($res->body());
        if (!$xml) {
            $this->error('XML non valido');
            return self::FAILURE;
        }

        // Ignora i namespace e prendi i nodi con attributi currency/rate
        $nodes = $xml->xpath('/*/*[local-name()="Cube"]/*[local-name()="Cube"]/*[local-name()="Cube"]') ?: [];
        $rates = ['EUR' => 1.0];
        foreach ($nodes as $n) {
            $cur = (string) $n['currency'];
            $rate = (string) $n['rate'];
            if ($cur && $rate) $rates[$cur] = (float) $rate;
        }

        // Aggiorna solo le valute presenti in tabella
        $valute = ValutaModel::select('id_valuta','codice_iso')->get();
        $now = now();
        $rows = [];
        foreach ($valute as $v) {
            if (!isset($rates[$v->codice_iso])) continue;
            $rows[] = [
                'id_valuta'  => $v->id_valuta,
                'tasso'      => $rates[$v->codice_iso],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if ($rows) {
            DB::table('tassi_cambio')->upsert($rows, ['id_valuta'], ['tasso','updated_at']);
        }

        $this->info('Aggiornati '.count($rows).' tassi.');
        return self::SUCCESS;
    }
}
