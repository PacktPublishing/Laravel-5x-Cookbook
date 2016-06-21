<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'url',
        'active',
        'title',
        'mark_down',
        'html',
    ];
    
    
}
