<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('OpenLanchonete')
            ->timezone('America/Sao_Paulo')
            ->dailyAt('19:00')
            ->days([Schedule::TUESDAY, Schedule:: WEDNESDAY, Schedule:: THURSDAY, Schedule:: FRIDAY, Schedule:: SATURDAY, Schedule:: SUNDAY ]);

        $schedule->command('closedLanchonete')
            ->timezone('America/Sao_Paulo')
            ->daily('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
