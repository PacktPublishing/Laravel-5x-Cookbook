<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class APIClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '\App\Interfaces\ClientInterface';
    }

}