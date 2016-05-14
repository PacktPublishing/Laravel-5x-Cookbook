<?php

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/24/2016
 * Time: 8:14 AM
 */
trait WishListTrait
{


    /**
     * @var \App\User
     */
    protected $user;


    protected function getComicDataForNonDefault()
    {
        return [
            "title" => "Spiderman",
            "urls" => [
                [
                    "type" => "detail",
                    "url" => "http://marvel.com/comics/issue/42882/lorna_the_jungle_girl_1954_6?utm_campaign=apiRef&utm_source=eeaef8ccb27b7aa1e20c80bd2f0d78a5"
                ],
                [
                    "type" => "reader",
                    "url" => "http://marvel.com/digitalcomics/view.htm?iid=26110&utm_campaign=apiRef&utm_source=eeaef8ccb27b7aa1e20c80bd2f0d78a5"
                ]
            ],
            "thumbnail" => [
                "path" => "http://i.annihil.us/u/prod/marvel/i/mg/9/40/50b4fc783d30f",
                "extension" => "jpg"
            ],
            "description" => "Spiderman"
        ];
    }
}