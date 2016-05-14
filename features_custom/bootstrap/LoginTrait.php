<?php

trait LoginTrait
{

    
    public function login($username = false, $password = false)
    {
        $this->visit('login');
        $this->fillField('email', ($username) ? :$this->user->email);
        $this->fillField('password', ($password) ? : env('ADMIN_PASSWORD'));
        $this->pressButton('Login');
    }
}