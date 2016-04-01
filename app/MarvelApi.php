<?php

namespace App;

use App\Interfaces\ComicClientInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;

class MarvelApi implements ComicClientInterface
{
    protected $key = false;
    protected $secret = false;
    protected $base_url = false;
    protected $api_version = '/v1/public';

    /**
     * @var Client
     */
    protected $client = null;

    public function __construct($key, $secret, Client $client)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->client = $client;
    }

    public function comics($title = false)
    {
        $query = ['query' => $this->makeAuth()];

        if($title)
        {
            $query['query'] = array_merge($query['query'], ['titleStartsWith' => $title]);
        }

        $results = $this->client->request('GET', $this->getApiVersion() . '/comics', $query);

        return json_decode($results->getBody(), true);
    }

    protected function makeAuth()
    {
        $ts = Carbon::now();
        $hash = md5($ts->timestamp . $this->secret . $this->key);
        return ['apikey' => $this->key, 'ts' => $ts->timestamp, 'hash' => $hash];
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function setBaseUrl($url)
    {
        $this->base_url = $url;
    }

    public function getApiVersion()
    {
        return $this->api_version;
    }

    public function setApiVersion($api_version)
    {
        $this->api_version = $api_version;
    }
}