<?php

namespace App\Jobs;

use App\ComicModel;
use App\Favorite;
use App\Jobs\Job;
use App\LatestFavorite;
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
     * @var ComicModel
     */
    public $comic;
    
    /**
     * @var LatestFavorite
     */
    private $favorite;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LatestFavorite $favorite)
    {
        $this->favorite = $favorite;

        $this->comic = (new ComicModel())->setComic($this->favorite->comic);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {

        $user = $this->favorite->user;

        $mailer->send('emails.fav', ['user' => $user, 'comic' => $this->comic], function ($m) use ($user) {
            $m->from('me@alfrednutile.info', 'ICDB');

            $m->to($user->email, "ICDB User")->subject('New Release in your Favorites Series!');
        });
    }

    /**
     * @return LatestFavorite
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * @param LatestFavorite $favorite
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;
    }

    /**
     * @return ComicModel
     */
    public function getComic()
    {
        return $this->comic;
    }

    /**
     * @param ComicModel $comic
     */
    public function setComic($comic)
    {
        $this->comic = $comic;
    }
}
