<?php

namespace App\Console;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
     
    protected $commands = [
        Commands\CapturaData::class,
        Commands\EnviarCatalogo::class,
        Commands\EnviarCorreoReclamo::class,
        Commands\EnviarCorreoPago::class,
        Commands\CapturaSeped::class,
        Commands\EnviarResumen::class,
        Commands\ProcesarAlcabala::class,
    ];
    
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('CapturaData:tablas')->everyMinute();
        $schedule->command('CapturaSeped:archivo')->everyMinute();
        $schedule->command('EnviarCorreoReclamo:mail')->everyMinute();
        $schedule->command('EnviarCorreoPago:mail')->everyMinute();
        $schedule->command('EnviarCatalogo:mail')->mondays()->at('08:30');
        $schedule->command('EnviarCatalogo:mail')->wednesdays()->at('08:30');
        $schedule->command('EnviarCatalogo:mail')->fridays()->at('08:30');
        $schedule->command('EnviarResumen:mail')->dailyAt('10:00');
        $schedule->command('ProcesarAlcabala:pedidos')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

