<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Profile extends Model
{
    protected $fillable = [
        'favorite_comic_character'
    ];

    protected $appends = ['profile_image'];

    public function getProfileImageAttribute()
    {
        $image = false;
        if(Auth::guest()) {
            $image = false;
        } elseif(File::exists(public_path(Auth::user()->id . '/example_profile.jpg'))) {
            $image = true;
        }
        return $this->attributes['profile_image'] = $image;
    }


}
