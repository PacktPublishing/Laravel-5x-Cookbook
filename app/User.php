<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable
{

    use Billable, HasSlug;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(){
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url');
    }

    public function wishlists()
    {
        return $this->hasMany(\App\WishList::class);
    }

    public function profile()
    {
        return $this->hasOne(\App\Profile::class);
    }

    public function favorites()
    {
        return $this->hasMany(\App\Favorite::class);
    }

    public function isAdmin()
    {
        return $this->is_admin == 1;    
    }
}
