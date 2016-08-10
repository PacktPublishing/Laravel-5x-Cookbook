<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery as m;
use Illuminate\Support\Facades\File;
use PHPUnit_Framework_Assert as PHPUnit;

class LoginPageDomainContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Laracasts\Behat\Context\DatabaseTransactions, \Laracasts\Behat\Context\Migrator;

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
        $this->user = factory(\App\User::class)->create();
    }

    /**
     * @Given I fill in the login form with my proper username and password
     */
    public function iFillInTheLoginFormWithMyProperUsernameAndPassword()
    {
        Auth::login($this->user);
        PHPUnit_Framework_Assert::assertFalse(Auth::guest());
    }

    /**
     * @Then I should be able to see my profile page
     */
    public function iShouldBeAbleToSeeMyProfilePage()
    {
        factory(\App\Profile::class)->create(
            ['favorite_comic_character' => "foo", 'user_id' => $this->user->id]
        );

        /** @var \App\Repositories\ProfileShowPage $profilePage */
        $profilePage = App::make(\App\Repositories\ProfileShowPage::class);

        $this->profile = $profilePage->showMyProfilePage();

        PHPUnit::assertTrue(Gate::allows('see-profile', $this->profile));

        PHPUnit::assertContains('foo', json_encode($this->profile, JSON_PRETTY_PRINT));
    }

    /**
     * @Then when I logout and revisit that profile page I will be redirected to the login page
     */
    public function whenILogoutAndRevisitThatProfilePageIWillBeRedirectedToTheLoginPage()
    {
        Auth::logout();
        PHPUnit::assertFalse(Gate::allows('see-profile', $this->profile));
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @Given I am an anonymous user
     */
    public function iAmAnAnonymousUser()
    {
        Auth::logout();
    }

    /**
     * @Given I go to the profile page
     */
    public function iGoToTheProfilePage()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\Profile::class)->create(['user_id' => $user->id]);

        /** @var \App\Http\Requests\ProfileShowRequest $auth */
        $auth = Mockery::mock(\App\Http\Requests\ProfileShowRequest::class)->makePartial();
        $auth->shouldReceive('route')->andReturn($user->url);
        $results = $auth->authorize();

        PHPUnit::assertTrue($results);

    }

    /**
     * @Then I should get redirected with an error message to let me know the problem
     */
    public function iShouldGetRedirectedWithAnErrorMessageToLetMeKnowTheProblem()
    {
        //@NOTE @iGoToTheProfilePage
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
        /** @var \App\Http\Requests\ProfileShowRequest $auth */
        $auth = Mockery::mock(\App\Http\Requests\ProfileShowRequest::class)->makePartial();
        $auth->shouldReceive('route')->andReturn($user->url);
        $results = $auth->authorize();

        PHPUnit::assertFalse($results);
    }

    /**
     * @afterScenario
     */
    public function cleanUp() {
        Mockery::close();
    }
}
