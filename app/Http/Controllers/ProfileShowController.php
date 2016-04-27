<?php

namespace App\Http\Controllers;

    use App\Profile;
    use App\Repositories\ProfileRepository;
    use App\Repositories\ProfileShowPage;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Response;

class ProfileShowController extends Controller
{

    /**
     * // 1. Setup Gate
     * // 2. Setup Repo
     */
    public function getAuthenticatedUsersProfile(Requests\ProfileShowRequest $request, ProfileShowPage $repository)
    {
        try
        {
            $profile = $repository->showMyProfilePage();

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
