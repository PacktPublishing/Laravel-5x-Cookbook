<?php

namespace App\Repositories;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/25/2016
 * Time: 7:15 AM
 */
class ProfileRepository
{


    public function getProfileForAuthenticatedUser()
    {
        return Profile::where('user_id', Auth::user()->id)->firstOrFail();
    }
    
    public function uploadUserProfileImage(Request $request)
    {
        if ($request->file('profile_image') && $request->file('profile_image')->isValid()) {
            Log::info("Going to save the file");

            $contents = file_get_contents($request->file('profile_image')->getRealPath());

            Storage::put(is_local_or_s3() . Auth::user()->id . '/example_profile.jpg', $contents);
            
            return true;
        }

        Log::info("No file :(");
        
        return false;
    }
}
