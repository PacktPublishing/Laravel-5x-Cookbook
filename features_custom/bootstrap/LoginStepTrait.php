<?php

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/24/2016
 * Time: 8:17 AM
 */
trait LoginStepTrait
{

    public function login()
    {
        $this->visit('/login');
    }
}