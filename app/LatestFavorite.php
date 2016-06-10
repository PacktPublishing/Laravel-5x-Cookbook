<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LatestFavorite extends Model
{

    protected $fillable = [
        'comic',
        'favorite_id',
        'user_id'
    ];

    protected $casts = [
        'comic' => 'array'
    ];

    public function favorite()
    {
        return $this->belongsTo(\App\Favorite::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
