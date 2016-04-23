<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $cast = [
        'comic_data' => 'array'
    ];
}
