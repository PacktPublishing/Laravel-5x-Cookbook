<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    public function view()
    {
        return view('test');
    }
    
    public function foo()
    {
        return Response::json("Here", 200);
    }
}
