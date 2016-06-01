<?php
/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/27/2016
 * Time: 7:37 AM
 */

namespace App\Repositories;

use App\Profile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ProfileShowPage extends ProfileRepository
{


    public function showMyProfilePage()
    {
        try {

            return Profile::myProfile();

        } catch (ModelNotFoundException $e) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();
            
            return $profile;
        }
    }
}
