<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\ValutaModel;

class AggiornaTassiCambio extends Command
{
    protected $signature = 'aggiorna:tassi-cambio'; // Definisco il nome del comando da usare in console del terminale
    protected $description = 'Scarica i tassi ECB (base EUR) e aggiorna tassi_cambio'; // Spiego cosa fa il comando quando lo elenco in Artisan

    /**
     * Esegue il comando: scarico i tassi dalla BCE, li prepara e aggiorna la tabella tassi_cambio.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml'; //  l'URL del file XML con i tassi giornalieri BCE
        $res = Http::timeout(15)->get($url); // Faccio la richiesta HTTP con timeout di 15 secondi

        if (!$res->ok()) { // Controllo se la risposta non è andata a buon fine
            $this->error('Download fallito'); // Mostro un messaggio di errore in console del terminale
            return self::FAILURE; // Esco dal comando segnalando fallimento
        }

        $xml = simplexml_load_string($res->body()); // Converto il corpo della risposta in un oggetto XML
        if (!$xml) { // Controllo se il parsing dell'XML è fallito
            $this->error('XML non valido'); // Avviso in console del terminale che l'XML non è leggibile
            return self::FAILURE; // Esco dal comando segnalando fallimento
        }

        $nodes = $xml->xpath('/*/*[local-name()="Cube"]/*[local-name()="Cube"]/*[local-name()="Cube"]') ?: []; // Estraggo i nodi con currency/rate usando XPath (o uso un array vuoto)
        $rates = ['EUR' => 1.0]; // Inizializzo l'array dei tassi partendo da EUR=1 perché la base è l'euro

        foreach ($nodes as $n) { // Scorro tutti i nodi trovati nell'XML
            $cur = (string) $n['currency']; // Leggo il codice valuta  dal nodo
            $rate = (string) $n['rate']; // Leggo il tasso associato dal nodo
            if ($cur && $rate) $rates[$cur] = (float) $rate; // Se ho entrambi, salvo il tasso convertendolo in float
        }

        $valute = ValutaModel::select('id_valuta', 'codice_iso')->get(); // Recupero dal DB le valute che mi interessano
        $now = now(); // Mi salvo l'istante attuale per riempire created_at e updated_at
        $rows = []; // Preparo l'array delle righe da inserire in tabella

        foreach ($valute as $v) { // Scorro tutte le valute presenti nel DB
            if (!isset($rates[$v->codice_iso])) continue; // Se non ho un tasso per quel codice ISO, salto la valuta
            $rows[] = [ // Aggiungo una riga pronta per l'inserimento
                'id_valuta'  => $v->id_valuta, // Metto l'id della valuta dal DB
                'tasso'      => $rates[$v->codice_iso], // Metto il tasso preso dall'XML in base al codice ISO
                'created_at' => $now, // Imposto la data di creazione uguale per tutte le righe
                'updated_at' => $now, // Imposto la data di aggiornamento uguale per tutte le righe
            ];
        }

        if ($rows) {
            DB::table('tassi_cambio')->truncate(); // Svuoto completamente la tabella dei tassi prima di reinserire i valori
            DB::table('tassi_cambio')->insert($rows); // Inserisco tutte le righe preparate in un'unica operazione
        }

        $this->info('Aggiornati ' . count($rows) . ' tassi.'); // Comunico in console del terminale quanti tassi ho aggiornato
        return self::SUCCESS; // Esco dal comando segnalando successo
    }
}
