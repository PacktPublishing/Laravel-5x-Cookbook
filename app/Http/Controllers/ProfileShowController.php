<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileShowRequest;
use App\Repositories\ProfileShowPage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileShowController extends Controller
{

    /**
     * // 1. Setup Gate
     * // 2. Setup Repo
     */
    public function getProfileForUserUsingSlug(ProfileShowRequest $request, ProfileShowPage $repository, $slug)
    {
        try {
            $profile = $repository->showProfileForUserFromSlug($slug);

            return view('profile.show', compact('profile'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('home')->with('message', "Could not find your profile :(");
        } catch (\Exception $e) {
            return redirect()->route('home')->with('message', "Error getting profile :(");
        }
    }
}
