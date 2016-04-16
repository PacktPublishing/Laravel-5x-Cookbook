<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Interfaces\ComicClientInterface;
use App\MarvelApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * @var MarvelApi
     */
    private $clientInterface;

    public function __construct(ComicClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = '';

        if($request->input('search')){
            $name =  $request->input('search');
            $message = sprintf("Your results for %s", $name);
            Session::flash('status', $message);
        }

        $results = $this->clientInterface->comics($name);

        $results = $this->transformResults($results);

        return Response::view('home.index', compact('results'));
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
