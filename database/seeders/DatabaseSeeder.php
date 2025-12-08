<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                StatoUtenteSeeder::class,
                ContattoSeeder::class,
                TipoRecapitoSeeder::class,
                RecapitoSeeder::class,

                ValutaSeeder::class,
                NazioneSeeder::class,
                ComuneSeeder::class,
                TipoIndirizzoSeeder::class,
                IndirizzoSeeder::class,
                // AccessoSeeder::class,
                PasswordSeeder::class,
                // SessioneSeeder::class,
                RuoloSeeder::class,
                AbilitaSeeder::class,
                ContattoRuoloSeeder::class,
                RuoloAbilitaSeeder::class,
                ConfigurazioneSeeder::class,
                AutenticazioneSeeder::class,
                LinguaSeeder::class,
                TraduzioneSeeder::class,
                TraduzioneCustomSeeder::class,
                RegistaSeeder::class,
                CategoriaSeeder::class,
                CategoriaTraduzioneSeeder::class,
                StreamingFileSeeder::class,
                SerieSeeder::class,
                FilmSeeder::class,
                StagioneSeeder::class,
                EpisodioSeeder::class,
                SerieTraduzioneSeeder::class,
                FilmTraduzioneSeeder::class,
                EpisodioTraduzioneSeeder::class,
                CategoriaSerieSeeder::class,
                AggiornaContatoriSerieSeeder::class,
                CategoriaFilmSeeder::class,
                // DurataVideoSeeder::class,
                AliquotaSeeder::class,

            ]

        );
         Artisan::call('aggiorna:tassi-cambio');
    }
}
