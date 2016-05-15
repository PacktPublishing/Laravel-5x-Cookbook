<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class ProfileEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @var ProfileRepository $repository
         */
        $repository = App::make(\App\Repositories\ProfileRepository::class);
        
        $profile = $repository->getProfileForAuthenticatedUser();

        if (Gate::allows('edit-profile', $profile)) {
            return true;
        }
        
        return false;
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
