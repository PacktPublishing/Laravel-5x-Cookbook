<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery as m;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use PHPUnit_Framework_Assert as PHPUnit;

class LoginPageUIContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $this->baseUrl = env('APP_URL');
    }

    

    /**
     * @AfterScenario
     */
    public static function after_scenario()
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
        $this->fillField();
    }

    /**
     * @Then I should be able to see my profile page
     */
    public function iShouldBeAbleToSeeMyProfilePage()
    {
        throw new PendingException();
    }

    /**
     * @Then when I logout and revisit that profile page I will be redirected to the login page
     */
    public function whenILogoutAndRevisitThatProfilePageIWillBeRedirectedToTheLoginPage()
    {
        throw new PendingException();
    }
}
