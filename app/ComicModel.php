<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/9/16
 * Time: 9:19 PM
 */

namespace App;


class ComicModel
{


    public $url;
    public $description;
    public $title;

    public function setComic($comic)
    {
        $this->title        = $comic['title'];
        $this->description  = $comic['description'];
        $this->url          = $comic['urls'][0]['url'];
        return $this;
    }

    public function getDescriptionSafe()
    {
        return htmlspecialchars($this->description, HTML_ENTITIES);
    }
}