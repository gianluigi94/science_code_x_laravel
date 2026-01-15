<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Elenco dei comandi disponibili nell'applicazione.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\AggiornaTassiCambio::class, // Aggiungo il comando che aggiorna i tassi di cambio
    ];

    /**
     * Imposto quando eseguire automaticamente i comandi programmati.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('aggiorna:tassi-cambio') // Programmo l'esecuzione del comando aggiorna:tassi-cambio
            ->dailyAt('17:10') // Lo faccio partire ogni giorno alle 17:10
            ->timezone('Europe/Rome'); // Uso il fuso orario di Roma per calcolare l'orario corretto
    }
}
