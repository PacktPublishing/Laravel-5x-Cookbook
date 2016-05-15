<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $casts = [
        'comic_data' => 'array'
    ];
}
