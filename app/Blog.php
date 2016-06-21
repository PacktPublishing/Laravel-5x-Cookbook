<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasSlug;

    protected $fillable = [
        'url',
        'active',
        'title',
        'mark_down',
        'html',
    ];

    public function getSlugOptions(){
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('url');
    }

}
