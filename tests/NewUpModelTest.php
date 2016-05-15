<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewUpModelTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @test
     */
    public function newup_example()
    {
        //create user using new up
//        $user = User::newInstance();
//
//        $user->name = 'foo';
//        $user->email = 'foo@foo.com';
//        $user->password = bcrypt("foobarbaz");
//
//        $user->save();
//
//        $this->assertNotNull(User::find($user->id));
    }
}
