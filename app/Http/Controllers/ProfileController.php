<?php

namespace App\Http\Controllers;

    use App\Profile;
    use App\Repositories\ProfileRepository;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{

    /**
     * // 1. Setup Gate
     * // 2. Setup Repo
     */
    public function getAuthenticatedUsersProfile(ProfileRepository $repository)
    {
        try
        {
            $profile = $repository->getProfileForAuthenticatedUser();

            if(!Gate::allows('see-profile', $profile))
                return redirect()->route('home')->with('message', "This is not your profile :(");
                
            return view('profile.show', compact('profile'));
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
