<?php

namespace App\Console\Commands;

use Alnutile\UniversalComicClient\ComicClientInterface;
use Alnutile\UniversalComicClient\MarvelApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GetFixtureForComic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getcomicbyname {name} {--name} {--series} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a comic by name will make fixture as well';

    /**
     * @var MarvelApi
     */
    private $clientInterface;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ComicClientInterface $clientInterface)
    {
        parent::__construct();

        $this->clientInterface = $clientInterface;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument("name");

        if($this->option("name"))
            $this->getSearchResults($name);

        //$this->getSeries($name);

        if($this->option("series"))
            $this->getSeriesStories($name);
    }
    
    public function getSeries($name)
    {
        $series_results = $this->clientInterface->series(15481);

        File::put(base_path('tests/fixtures/series_' . snake_case($name) . '.json'), json_encode($series_results, JSON_PRETTY_PRINT));

        $this->info(var_dump($series_results));
    }

    private function getSearchResults($name)
    {
        $results = $this->clientInterface->comics($name, 0);

        $name = snake_case($name);

        File::put(base_path('tests/fixtures/' . $name . '.json'), json_encode($results['data']['results'], JSON_PRETTY_PRINT));

        $this->info(var_dump($results['data']['results']));
    }

    private function getSeriesStories($id)
    {
        $results = $this->clientInterface->seriesStories($id, 0);

        $name = snake_case($id);

        File::put(base_path('tests/fixtures/series_stories_' . $name . '.json'), json_encode($results, JSON_PRETTY_PRINT));

        $this->info(var_dump($results));
    }
}
