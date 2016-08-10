<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CleanupBehatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cleanupProfile() {
        if(Auth::user()->email != 'demo@foo.com') {
            redirect()->route('home');
        }

        $user = User::where('email', 'demo@foo.com')->firstOrFail();
        $user->favorite_comic_character = "CleanUp";
        $user->save();

        redirect()->route('profile', [$user->url]);
    }
}
