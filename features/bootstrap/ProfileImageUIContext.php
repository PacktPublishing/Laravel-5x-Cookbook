<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class ProfileImageUIContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions, WishListTrait, LoginTrait;

    private $baseUrl;

    /**
     * @var \App\Profile
     */
    private $profile;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL');
    }

    

    /**
     * @Given I am on the page to edit my profile
     */
    public function iAmOnThePageToEditMyProfile()
    {
        //Login
        $this->user = factory(\App\User::class)->create(['password' => bcrypt('foobarbaz')]);
        $this->profile = factory(\App\Profile::class)->create(['user_id' => $this->user->id]);
        //Visit Edit Page
        $this->login($this->user->email, 'foobarbaz');
        $this->visit('profile');

        /**
         * Just to make sure we are not dealing with a false positive
         */
        $this->assertElementNotOnPage('img-thumbnail');

        $this->visit('profile/edit');
    }

    /**
     * @Then I should be able to upload an image file
     */
    public function iShouldBeAbleToUploadAnImageFile()
    {
        //Upload file to form
        //$this->attachFileToField('profile_image', 'example_image.jpg');
        $this->attachFileToField('profile_image', 'https://dl.dropboxusercontent.com/s/a8cu212zp5j3ymy/example_image.jpg?dl=0');
        //Submit form
        $this->pressButton('Save');
    }

    /**
     * @Then then see it on my profile view page
     */
    public function thenSeeItOnMyProfileViewPage()
    {
        $this->visit('profile');
        $this->assertElementOnPage('img-thumbnail');
    }
}
