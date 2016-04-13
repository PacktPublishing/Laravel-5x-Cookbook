<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{

    public function index()
    {

        $title = "Welcome to ICDB";

        return view('home.index', compact("title"));
    }
}
