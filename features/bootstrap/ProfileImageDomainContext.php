<?php

use App\User;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Mockery as m;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use PHPUnit_Framework_Assert as PHPUnit;

class ProfileImageDomainContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions, WishListTrait, LoginTrait;

    private $baseUrl;
    private $profile;

    /**
     * @var \App\Repositories\ProfileRepository
     */
    private $repo;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL');
    }

    /**
     * @AfterScenario @cleanup_user_profile
     */
    public function after_scenario()
    {
        if(File::exists(public_path('storage/' . $this->user->id)))
            File::deleteDirectory(public_path('storage/' . $this->user->id));
        m::close();
    }

    /**
     * @Given I am on the page to edit my profile
     */
    public function iAmOnThePageToEditMyProfile()
    {
        //Using this step to setup the "World"
        // User
        // User's Profile
        // Image fixtures in place
        $this->user = factory(\App\User::class)->create();

        Auth::login($this->user);

        if(!File::exists(base_path('tests/fixtures/example_profile.jpg')))
            File::copy(base_path('tests/fixtures/profile.jpg'),base_path('tests/fixtures/example_profile.jpg'));

        //make sure I have a profile
        factory(\App\Profile::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * @Then I should be able to upload an image file
     */
    public function iShouldBeAbleToUploadAnImageFile()
    {
        $request = new \Illuminate\Http\Request();
        $file = new \Symfony\Component\HttpFoundation\FileBag();
        $path = base_path('tests/fixtures/example_profile.jpg');
        $originalName = 'example_profile.jpg';
        $upload = new \Illuminate\Http\UploadedFile($path, $originalName, null, null, null, TRUE);
        $file->set('profile_image', $upload);
        $request->files = $file;
        $this->repo = new \App\Repositories\ProfileRepository();
        $results = $this->repo->uploadUserProfileImage($request);

        PHPUnit::assertTrue($results, "Repo did not return true");

        PHPUnit::assertTrue(File::exists(public_path('storage/' . $this->user->id . '/example_profile.jpg')), "File Not found");
    }

    /**
     * @Then then see it on my profile view page
     */
    public function thenSeeItOnMyProfileViewPage()
    {
        //Reloading the profile to see if it now has the imaqge
        $this->profile = $this->repo->getProfileForAuthenticatedUser();
        PHPUnit::assertArrayHasKey('profile_image', $this->profile->toArray(), "Key for image not found with profile");
        PHPUnit::assertNotEmpty($this->profile->toArray()['profile_image'], "File not found with profile");
    }

    /**
     * @Given I upload a non jpg file I should get an error message
     */
    public function iUploadANonJpgFileIShouldGetAnErrorMessage()
    {
        $request = new \App\Http\Requests\ProfileUploadRequest();

        $file = new \Symfony\Component\HttpFoundation\FileBag();
        $path = base_path('tests/fixtures/example_profile.png');
        $originalName = 'example_profile.png';
        $upload = new \Illuminate\Http\UploadedFile($path, $originalName, null, null, null, TRUE);
        $file->set('profile_image', $upload);
        $request->files = $file;
//
//        $request->validate();


        throw new PendingException();
    }

    /**
     * @Given I upload a file that is too large I should get an error message
     */
    public function iUploadAFileThatIsTooLargeIShouldGetAnErrorMessage()
    {
        throw new PendingException();
    }
}
