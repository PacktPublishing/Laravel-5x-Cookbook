<?php
/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/17/2016
 * Time: 5:59 PM
 */

namespace App;


use App\Interfaces\ComicClientInterface;

class SearchComicsRepository
{

    /**
     * @var MarvelApi
     */
    private $clientInterface;

    public function __construct(ComicClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    public function getComicsByName($name = false)
    {
        $results = $this->clientInterface->comics($name);

        $results = $this->transformResults($results);   
        
        return $results;
    }

    private function transformResults($results)
    {
        if(isset($results['data']))
            return $results['data'];

        return $this->returnEmptyResults();
    }

    private function returnEmptyResults()
    {
        $results = [
            'results'   => [],
            'offset'    => 0,
            'limit'     => 20,
            'total'     => 0,
            'count'     => 0
        ];

        return $results;

    }
}