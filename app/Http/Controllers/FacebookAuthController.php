<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteManager;

class FacebookAuthController extends Controller
{

    private $providerUser;

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $this->providerUser = Socialite::driver('facebook')->user();
        
        try
        {
            if($user = User::where('email', $this->providerUser->getEmail())->first()) {
                Auth::login($user);
                return Redirect::to('/')->with("message", "Thanks for setting up Facebook!");
            } else {
                $user = $this->createUserAndProfile();
                Auth::login($user);

                return Redirect::to('/')->with("message", "Thanks for setting up Facebook!");
            }

            return Redirect::to('login')->withError("We could not log your in");

        } catch (\Exception $e) {
            return Redirect::to('login')->withError("We could not log your in");
        }
    }

    private function createUserAndProfile()
    {
        $user = new User();

        $user->email        = $this->providerUser->getEmail();
        $user->name         = $this->providerUser->getName();
        $user->password     = bcrypt(str_random(32));
        $user->save();

        $profile = new Profile();
        $profile->favorite_comic_character = 'Spider-man';
        $profile->user_id = $user->id;
        $profile->save();
        
        return $user;
    }
}
