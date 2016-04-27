<?php
/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/27/2016
 * Time: 7:37 AM
 */

namespace App\Repositories;


use App\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileShowPage extends ProfileRepository
{


    public function showMyProfilePage()
    {
        return Profile::myProfile();
    }

}