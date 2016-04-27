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
        $this->baseUrl = env('APP_URL');
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
        //Make a profile to see
        factory(\App\Profile::class)->create([
            'favorite_comic_character' => 'Spider-Man', 'user_id' => $this->user->id]);
        //Now visit profile
        $this->visit(route('profile'));
        //see my profile
        $this->assertPageContainsText('Favorite Comic Character: Spider-Man');
        $this->assertPageNotContainsText('Error getting profile :(');
    }

    /**
     * @Then when I logout and revisit that profile page I will be redirected to the login page
     */
    public function whenILogoutAndRevisitThatProfilePageIWillBeRedirectedToTheLoginPage()
    {
        $this->visit('logout');
        
        $this->visit('profile');

        $this->assertPageContainsText('You need to login first');
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
        $this->visit('profile');
    }

    /**
     * @Then I should get redirected with an error message to let me know the problem
     */
    public function iShouldGetRedirectedWithAnErrorMessageToLetMeKnowTheProblem()
    {
        $this->assertPageContainsText('You need to login first');
    }
}
