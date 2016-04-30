<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileUploadRequest extends Request
{

    protected $kilobytes = 2000;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'profile_image' => 'mimes:jpeg,jpg|between:0,' . $this->getKilobytes(),
        ];
    }

    /**
     * @return int
     */
    public function getKilobytes()
    {
        return $this->kilobytes;
    }

    /**
     * @param int $kilobytes
     */
    public function setKilobytes($kilobytes)
    {
        $this->kilobytes = $kilobytes;
    }
}
