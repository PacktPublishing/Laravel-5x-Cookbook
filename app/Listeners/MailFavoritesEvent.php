<?php

namespace App\Listeners;

use App\Events\NewFavoriteSeriesEvent;
use App\Jobs\SendFavoritesEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailFavoritesEvent
{
    use DispatchesJobs;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewFavoriteSeriesEvent  $event
     * @return void
     */
    public function handle(NewFavoriteSeriesEvent $event)
    {
        $this->dispatch(new SendFavoritesEmail($event->favorite));
    }
}
