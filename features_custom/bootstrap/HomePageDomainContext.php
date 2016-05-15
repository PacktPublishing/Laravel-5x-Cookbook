<?php
use App\SearchComicsRepository;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Mockery as m;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/17/2016
 * Time: 5:39 PM
 */
class HomePageDomainContext extends MinkContext implements Context, SnippetAcceptingContext
{


    private $baseUrl;
    private $results;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL');
    }

    /**
     * @Then I will see a search bar
     */
    public function iWillSeeASearchBar()
    {
        $client = m::mock(\App\Interfaces\ComicClientInterface::class);

        $fixture = File::get(base_path('tests/fixtures/results_no_name.json'));

        $data = ['data' => json_decode($fixture, true)];

        $client->shouldReceive('comics')->andReturn($data);

        $search = new SearchComicsRepository($client);

        $results = $search->getComicsByName();

        PHPUnit::assertNotNull($results['results']);

        PHPUnit::assertContains("Lorna the Jungle Girl", json_encode($results, JSON_PRETTY_PRINT));
    }


    /**
     * @Then I add the search term :arg1 and search
     */
    public function iAddTheSearchTermAndSearch($arg1)
    {
        $client = m::mock(\App\Interfaces\ComicClientInterface::class);

        $fixture = File::get(base_path('tests/fixtures/results_with_name.json'));

        $data = ['data' => json_decode($fixture, true)];

        $client->shouldReceive('comics')->andReturn($data);

        $search = new SearchComicsRepository($client);

        $results = $search->getComicsByName($arg1);

        $this->makeFixture('results_with_name.json', $results);

        PHPUnit::assertNotNull($results['results']);

        $this->results = $results;
    }

    /**
     * @Then I will see lots and lots of comics and images
     */
    public function iWillSeeLotsAndLotsOfComicsAndImages()
    {
        PHPUnit::assertNotContains("Lorna the Jungle Girl", json_encode($this->results, JSON_PRETTY_PRINT));
    }

    protected function makeFixture($filename, $content)
    {
        File::put(base_path('tests/fixtures/' . $filename),
            json_encode($content, JSON_PRETTY_PRINT));
    }

    /**
     * @AfterScenario
     */
    public function after_scenario()
    {
        m::close();
    }
}
