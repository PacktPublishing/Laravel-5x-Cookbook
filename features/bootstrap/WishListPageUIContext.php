<?php

use App\User;
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

class WishListPageUIContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions, WishListTrait, LoginTrait;

    private $baseUrl;

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
     * @Given I login and visit the wishlist page
     */
    public function iLoginAndVisitTheWishlistPage()
    {
        $this->user = User::first();
        $this->login();
    }

    /**
     * @Then I should see Lorna but not see Spiderman
     */
    public function iShouldSeeLornaButNotSeeSpiderman()
    {
        factory(\App\WishList::class, 3)->create(['user_id' => $this->user->id]);

        factory(\App\WishList::class, 1)->create(['user_id' => 2, 'comic_data' => $this->getComicDataForNonDefault()]);

        $this->visit(route('wish_lists.index'));

        $this->assertPageContainsText('Lorna');

        $this->assertPageNotContainsText('Spiderman');
    }



    /**
     * @Given I wait
     */
    public function iWait()
    {
        sleep(3);
    }
}
