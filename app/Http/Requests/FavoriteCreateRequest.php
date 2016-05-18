<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FavoriteCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comic' => 'required'
        ];
    }
}
