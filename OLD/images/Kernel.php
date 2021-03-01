<?php

namespace App\Console;

use App\Console\Commands\RegisterChatServerCommand;
use App\Console\Commands\SendReminders;
use App\Console\Commands\FixImagen;
use App\Console\Commands\TaskRecurrencyGeneratorCommand;
use App\Console\Commands\deleteOtro;
use App\Console\Commands\deleteItemsDuplicate;
use App\Console\Commands\Housekeeping;
use App\Console\Commands\GenerateWorkLoadData;
use App\Console\Commands\DashBoard;
use App\Console\Commands\deleteResourceDuplicate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        RegisterChatServerCommand::class,
        FixImagen::class,
        Housekeeping::class,
        deleteOtro::class,
        deleteItemsDuplicate::class,
        TaskRecurrencyGeneratorCommand::class,
        GenerateWorkLoadData::class,
        DashBoard::class,
        deleteResourceDuplicate::class,
        SendReminders::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dd:housekeeping')->daily();
        // $schedule->command('dd:recurrency')->daily();
        $schedule->command('dd:occupation')->daily();
        $schedule->command('dd:dashboard')->daily();
        $schedule->command('dd:send_reminders')->everyMinute();
        
        $schedule->command('dd:send_audit_emails')->everyThirtyMinutes();
        
        // $schedule->command('dd:generateworkload')->daily()->then(function () {
        //     $this->call('dd:dashboard');
        // });
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
