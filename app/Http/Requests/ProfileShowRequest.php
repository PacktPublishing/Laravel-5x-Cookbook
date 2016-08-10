<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Repositories\ProfileShowPage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileShowRequest extends Request
{

    protected $profile;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guest()) {
            return false;
        }
        /** @var \App\Repositories\ProfileShowPage $profilePage */
        $profilePage = App::make(\App\Repositories\ProfileShowPage::class);

        $user = $profilePage->showProfileForUserFromSlug($this->route('slug'));

        return Auth::user()->id == $user->profile->user_id;
    }

    public function forbiddenResponse()
    {
        return redirect('login')->with('message', "You need to login first");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
