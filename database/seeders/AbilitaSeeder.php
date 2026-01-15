<?php

namespace Database\Seeders;

use App\Models\AbilitaModel;
use Illuminate\Database\Seeder;

class AbilitaSeeder extends Seeder
{
    /**
     * Inserimento dei dati iniziali nel database.
     *
     * @return void
     */
    public function run(): void
    {
        AbilitaModel::create(['nome' => 'visualizzare_media',       'sku' => 'visualizzare_media']);
        AbilitaModel::create(['nome' => 'visualizzare_analisi',     'sku' => 'visualizzare_analisi']);
        AbilitaModel::create(['nome' => 'visualizzare_pubblicita',  'sku' => 'visualizzare_pubblicita']);

        // MEDIA
        AbilitaModel::create(['nome' => 'aggiungere_media',         'sku' => 'aggiungere_media']);
        AbilitaModel::create(['nome' => 'modificare_media',         'sku' => 'modificare_media']);
        AbilitaModel::create(['nome' => 'eliminare_media',          'sku' => 'eliminare_media']);

        // PUBBLICITÀ
        AbilitaModel::create(['nome' => 'aggiungere_pubblicita',    'sku' => 'aggiungere_pubblicita']);
        AbilitaModel::create(['nome' => 'modificare_pubblicita',    'sku' => 'modificare_pubblicita']);
        AbilitaModel::create(['nome' => 'eliminare_pubblicita',     'sku' => 'eliminare_pubblicita']);

        // ACCOUNT
        AbilitaModel::create(['nome' => 'gestire_account',          'sku' => 'gestire_account']);

        // AUTENTICAZIONE
        AbilitaModel::create(['nome' => 'registrarsi',              'sku' => 'registrarsi']);
        AbilitaModel::create(['nome' => 'collegarsi',               'sku' => 'collegarsi']);

        // AMMINISTRAZIONE
        AbilitaModel::create(['nome' => 'gestire_admin',            'sku' => 'gestire_admin']);
        AbilitaModel::create(['nome' => 'moderatore',               'sku' => 'moderatore']);

        // SISTEMA
        AbilitaModel::create(['nome' => 'sistemista',               'sku' => 'sistemista']);
    }
}
