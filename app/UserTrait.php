<?php
/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 5/16/2016
 * Time: 7:19 PM
 */

namespace App;


use Illuminate\Support\Facades\Auth;

trait UserTrait
{

    public function getUserInfo()
    {
        if(Auth::guest())
            return [];
        
        return Auth::user()->load('favorites');
    }
    
}
