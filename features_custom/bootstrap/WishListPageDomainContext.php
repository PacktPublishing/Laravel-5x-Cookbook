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

class WishListPageDomainContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions, WishListTrait;

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
        $this->user = factory(\App\User::class)->create();
        Auth::login($this->user);
    }

    /**
     * @Then I should see Lorna but not see Spiderman
     */
    public function iShouldSeeLornaButNotSeeSpiderman()
    {
        factory(\App\WishList::class, 3)->create(['user_id' => $this->user->id]);

        factory(\App\WishList::class, 1)->create(['user_id' => 2, 'comic_data' => $this->getComicDataForNonDefault()]);

        $user = $this->user->load('wishlists');

        $results = $user->wishlists->toArray();

        PHPUnit::assertCount(3, $results);

        PHPUnit::assertNotContains('Spiderman', json_encode($results, JSON_PRETTY_PRINT));
    }
}
