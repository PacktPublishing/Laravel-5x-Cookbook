<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery as m;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use PHPUnit_Framework_Assert as PHPUnit;

class LoginPageUIContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions, LoginTrait;

    private $baseUrl;

    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var \App\Profile
     */
    private $profile;

    public function __construct()
    {
        //$this->baseUrl = env('APP_URL');
    }

    

    /**
     * @AfterScenario
     */
    public function after_scenario()
    {
        m::close();
    }


    /**
     * @Given I am on the login page
     */
    public function iAmOnTheLoginPage()
    {
        /**
         * @NOTE route('login')
         *   would be nicer
         */
        $this->visit('login');
    }

    /**
     * @Given I fill in the login form with my proper username and password
     */
    public function iFillInTheLoginFormWithMyProperUsernameAndPassword()
    {
        $this->user = User::first();
        $this->login();
    }

    /**
     * @Then I should be able to see my profile page
     */
    public function iShouldBeAbleToSeeMyProfilePage()
    {
        $this->visit('/setup/profile');
        $this->visit($this->baseUrl . '/profile/' . $this->user->url);
        $this->assertPageContainsText('Who are you?:');
        $this->assertPageContainsText('Favorite Comic Character:');
        $this->assertPageNotContainsText('Error getting profile :(');
    }

    /**
     * @Then if I try to see another persons page I should get rejected
     */
    public function ifITryToSeeAnotherPersonsPageIShouldGetRejected()
    {
        $user = factory(\App\User::class)->create();

        factory(\App\Profile::class)->create(
            ['favorite_comic_character' => "foo", 'user_id' => $user->id]
        );

        $this->visit($this->baseUrl . '/profile/' . $user->url);
        $this->assertPageNotContainsText('Who are you?:');
        $this->assertPageNotContainsText('Favorite Comic Character:');
    }

    /**
     * @AfterScenario @profile
     */
    public function cleanupProfile() {
        $this->visit('/cleanup/profile');
    }
    

    /**
     * @Given I am an anonymous user
     */
    public function iAmAnAnonymousUser()
    {
        $this->visit('logout');
    }

    /**
     * @Given I go to the profile page
     */
    public function iGoToTheProfilePage()
    {
        $slug = \App\User::first()->url;
        $this->visit('/profile/' . $slug);
    }

    /**
     * @Then I should get redirected with an error message to let me know the problem
     */
    public function iShouldGetRedirectedWithAnErrorMessageToLetMeKnowTheProblem()
    {
        $this->assertPageContainsText('You need to login first');
    }
}
