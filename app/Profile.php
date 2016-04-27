<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'favorite_comic_character'
    ];

    protected $appends = ['profile_image'];

    public function getProfileImageAttribute()
    {

        $image  = false;
        $path   = (!Auth::guest()) ? Auth::user()->id . '/example_profile.jpg' : false;

        if(Auth::guest()) {
            $image = false;
        }
        elseif(env('FILESYSTEM_DEFAULT') == 'local') {
            if (File::exists(public_path('storage/' . $path))) {
                $image = Storage::url($path);
            } else {
                $image = false;
            }
        }
        else {
            if(Storage::exists($path))
            {
                $image = $this->getSignedUrl($path, 10);
            }

        }

        return $this->attributes['profile_image'] = $image;
    }

    public function scopeMyProfile($query)
    {
        return $query->where('user_id', Auth::user()->id)->firstOrFail();
    }

    public function getSignedUrl($filename_and_path, $expires_minutes = '10')
    {
        $client     = Storage::getDriver()->getAdapter()->getClient();
        $bucket     = env('PROFILE_IMAGE_BUCKET');

        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $filename_and_path
        ]);

        $request = $client->createPresignedRequest($command, Carbon::now()->addMinutes($expires_minutes));

        return (string) $request->getUri();
    }
}
