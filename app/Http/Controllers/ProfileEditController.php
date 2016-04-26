<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Gate;

class ProfileEditController extends Controller
{
    public function getAuthenticatedUsersProfileToEdit(ProfileRepository $repository)
    {
        try
        {
            $profile = $repository->getProfileForAuthenticatedUser();
            
            if(!Gate::allows('edit-profile', $profile))
                return redirect()->route('home')->with('message', "This is not your profile :(");

            return view('profile.edit', compact('profile'));
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->route('home')->with('message', "Could not find your profile :(");
        }
        catch (\Exception $e)
        {
            return redirect()->route('home')->with('message', "Error getting profile :(");
        }
    }

    public function updateAuthenticatedUsersProfile(Requests\ProfileEditRequest $request, ProfileRepository $repository)
    {
        try
        {
            /**
             * We do auth at the ProfileRequest Level
             */
            $repository->uploadUserProfileImage($request);

            return redirect()->route('profile.show')->with('message', "Image Updated");
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->route('home')->with('message', "Could not find your profile :(");
        }
        catch (\Exception $e)
        {
            return redirect()->route('home')->with('message', "Error getting profile :(");
        }
    }
}
