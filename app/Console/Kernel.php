<?php

namespace App\Console;

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
        // Commands\Inspire::class,
        Commands\GetFixtureForComic::class,
        Commands\GetUsersLatestsFavoritesConsole::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->command(\App\Console\Commands\GetUsersLatestsFavoritesConsole::class)
            ->dailyAt('22:00')
            ->sendOutputTo(storage_path('favorites_job.txt'))
            ->emailOutputTo('me@alfrednutile.info');
    }
}
