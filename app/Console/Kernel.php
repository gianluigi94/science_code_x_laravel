<?php
// app/Console/Kernel.php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AggiornaTassiCambio::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // L'ECB pubblica intorno alle 16:00 CET; aggiornamento alle 17:10 Europe/Rome
        $schedule->command('aggiorna:tassi-cambio')
         ->dailyAt('17:10')
         ->timezone('Europe/Rome');

    }
}
