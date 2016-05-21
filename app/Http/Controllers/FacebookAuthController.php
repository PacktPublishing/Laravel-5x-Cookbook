<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = Socialite::driver('facebook')->user();
        
        try
        {
            if($user = User::where('email', $providerUser->getEmail())->first()) {
                Auth::login($user);

                return $this->redirect('/')->with("message", "Thanks for setting up Facebook!");

            } else {
                $user = new User();

                $user->email        = $providerUser->getEmail();
                $user->name         = $providerUser->getName();
                $user->password     = bcrypt(str_random(32));
                $user->save();

                $profile = new Profile();
                $profile->favorite_comic_character = 'Spider-man';
                $profile->user_id = $user->id;
                $profile->save();
                Auth::login($user);

                return redirect('/')->with("message", "Thanks for setting up Facebook!");
            }

            return redirect('login')->withError("We could not log your in");

        } catch (\Exception $e) {
            return redirect('login')->withError("We could not log your in");
        }
    }
}
