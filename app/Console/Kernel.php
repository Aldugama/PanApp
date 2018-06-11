<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $cronLog = storage_path('logs/cron.log');
        if (!File::exists($cronLog)) {
            File::put($cronLog, '');
        }

        //* Borra todos los pedidos cancelados o finalizados mensualmente
        //? Hay que ejecutar el comando shedule:run en el servidor
        $schedule->command('delete:orders')->monthlyOn(1, '12:00');

        //* Modifica el estado de los pedidos activos a pendientes
        $schedule->command('change:status')->dailyAt('10:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
