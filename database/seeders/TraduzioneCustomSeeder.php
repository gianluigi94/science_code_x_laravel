<?php

namespace Database\Seeders;

use App\Models\TraduzioneCustomModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TraduzioneCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TraduzioneCustomModel::create([
            'chiave' => 'ui.carosello.prev_btn.title',
            'id_lingua' => 1,
            'valore' => 'Vedi la locandina precedente',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.carosello.prev_btn.title',
            'id_lingua' => 2,
            'valore' => 'See the previous slide',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.carosello.next_btn.title',
            'id_lingua' => 1,
            'valore' => 'Vedi la prossima locandina',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.carosello.next_btn.title',
            'id_lingua' => 2,
            'valore' => 'See the next slide',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.carosello.novita.label',
            'id_lingua' => 2,
            'valore' => 'What\'s new',
        ]);




        TraduzioneCustomModel::create([
            'chiave' => 'ui.scheda.anno.label',
            'id_lingua' => 1,
            'valore' => 'anno di uscita',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.scheda.anno.label',
            'id_lingua' => 2,
            'valore' => 'release year',
        ]);


        TraduzioneCustomModel::create([
            'chiave' => 'ui.scheda.regista.label',
            'id_lingua' => 2,
            'valore' => 'directed by',
        ]);

        TraduzioneCustomModel::create([
            'chiave' => 'ui.footer.privacy.title',
            'id_lingua' => 1,
            'valore' => 'leggi l’informativa su privacy e cookie',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.footer.privacy.title',
            'id_lingua' => 2,
            'valore' => 'read the privacy & cookies policy',
        ]);


        TraduzioneCustomModel::create([
            'chiave' => 'ui.search.title.label',
            'id_lingua' => 1,
            'valore' => 'cerca per film, serie o regista',
        ]);
        TraduzioneCustomModel::create([
            'chiave' => 'ui.search.title.label',
            'id_lingua' => 2,
            'valore' => 'search by movie, series, or directors',
        ]);
    }
}
