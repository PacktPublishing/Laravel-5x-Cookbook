<?php

namespace App\Jobs;

use App\ComicModel;
use App\Favorite;
use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendFavoritesEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Favorite
     */
    private $favorite;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {

        $comic = (new ComicModel())->setComic($this->favorite->comic);

        $user = $this->favorite->user;

        Mail::send('emails.fav', ['user' => $user, 'comic' => $comic], function ($m) use ($user) {
            $m->from('me@alfrednutile.info', 'ICDB');

            $m->to($user->email, "ICDB User")->subject('New Release in your Favorites Series!');
        });
    }
}
