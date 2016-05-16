<?php

namespace App\Http\Controllers;

use App\Interfaces\ComicClientInterface;
use App\MarvelApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SearchComics extends Controller
{
    /**
     * @var MarvelApi
     */
    private $clientInterface;

    public function __construct(ComicClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    public function searchComicsByName(Request $request)
    {
        try {
            $name = $request->input('name');

            $offset  = $request->input('offset');
            $results = $this->clientInterface->comics($name, $offset);

            return Response::json(['data' => $results['data'], 'message' => "Success Getting Comics"], 200);
        } catch (\Exception $e) {
            return Response::json(
                ['data' => [], 'message' => sprintf("Error Getting Comics %s", $e->getMessage())], 400);
        }
    }

    protected function makeFixture($results, $name = 'no_name')
    {
        //File::put(base_path('tests/fixtures/search_no_name.json'),
        //  json_encode($results, JSON_PRETTY_PRINT));
    }
}
