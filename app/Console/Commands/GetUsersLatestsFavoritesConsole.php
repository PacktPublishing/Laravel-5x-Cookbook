<?php

namespace App\Console\Commands;

use App\Events\NewFavoriteSeriesEvent;
use App\Events\NewSeriesFavorites;
use App\Favorite;
use Alnutile\UniversalComicClient\ComicClientInterface;
use App\Jobs\SendFavoritesEmail;
use App\LatestFavorite;
use App\MarvelApi;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class GetUsersLatestsFavoritesConsole extends Command
{
    use \App\SeriesTrait, \Illuminate\Foundation\Bus\DispatchesJobs;

    protected $signature = 'comics:getlatestfavs';

    protected $description = 'Get User Faves and Create Lastest notices';

    /**
     * @var MarvelApi
     */
    private $clientInterface;

    public function __construct(ComicClientInterface $clientInterface)
    {
        parent::__construct();
        $this->clientInterface = $clientInterface;
    }

    public function handle()
    {
        try {
            $this->processFavs();
        } catch (\Exception $e)
        {
            $message = sprintf("Error processing favorites %s", $e->getMessage());
            Log::debug($message);
            $this->error($message);
        }
    }

    protected function processFavs()
    {
        $favorites = Favorite::all();
        $count = 0;
        foreach($favorites as $favorite)
        {
            if($series_id = $this->isSeries($favorite->comic))
            {
                $results = $this->clientInterface->seriesStories($series_id);
                if($results && $future = $this->hasFutureSeriesDate($results['data']['results']))
                {
                    foreach($future as $comic)
                    {
                        /**
                         * Let's prevent duplicates
                         */
                        $repeat = LatestFavorite::where('user_id', $favorite->user_id)
                            ->where('favorite_id', $favorite->id)
                            ->where("comic->id", 'LIKE', $comic['id'])->first();

                        if(!$repeat)
                        {
                            $latest = LatestFavorite::create([
                                'comic' => $comic, 
                                'user_id' => $favorite->user_id,
                                'favorite_id' => $favorite->id]);

                            $count++;

                            Event::fire(new NewFavoriteSeriesEvent($latest));
                        }

                    }
                }
            }
        }

        $this->info(sprintf("Made %d LatestFavorites", $count));
    }

}
