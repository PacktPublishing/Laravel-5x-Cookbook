<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Repositories\ProfileRepository;
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
        /**
         * @var ProfileShowPage $repository
         */
        if (Auth::guest()) {
            return false;
        }

        $repository = App::make(\App\Repositories\ProfileShowPage::class);

        $profile = $repository->showMyProfilePage();

        return Gate::allows('see-profile', $profile);
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
