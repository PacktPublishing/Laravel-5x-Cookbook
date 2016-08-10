<?php
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

    public function showProfileForUserFromSlug($slug)
    {
        try {

            return \App\User::fromSlug($slug);

        } catch (ModelNotFoundException $e) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();

            return $profile;
        }
    }
}
