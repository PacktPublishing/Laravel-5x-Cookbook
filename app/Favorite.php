<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $fillable = [
        'comic'
    ];

    protected $casts = [
        'comic' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
