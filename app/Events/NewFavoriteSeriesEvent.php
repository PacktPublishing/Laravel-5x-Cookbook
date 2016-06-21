<?php

namespace App\Events;

use App\ComicModel;
use App\Events\Event;
use App\Favorite;
use App\LatestFavorite;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewFavoriteSeriesEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var LatestFavorite
     */
    public $favorite;
    public $comic;

    public function __construct(LatestFavorite $favorite)
    {
        $this->favorite = $favorite;
        $this->comic = (new ComicModel())->setComic($favorite->comic);
    }

    public function broadcastAs()
    {
        return 'favorites.series';
    }

    public function broadcastOn()
    {
        return ['user-' . $this->favorite->user_id];
    }

}
