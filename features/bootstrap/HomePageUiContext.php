<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/17/2016
 * Time: 5:39 PM
 */
class HomePageUiContext extends MinkContext implements Context, SnippetAcceptingContext
{


    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL');
    }

    /**
     * @Then I will see a search bar
     */
    public function iWillSeeASearchBar()
    {
        /**
         * Easy enough to fill the field to basically assert
         * it is there to fill
         */
        $this->fillField("search", "Spider-Man");
    }

    /**
     * @Then I add the search term :arg1 and search
     */
    public function iAddTheSearchTermAndSearch($arg1)
    {
        $this->fillField("search", "Spider-Man");
        $this->pressButton("Search");
    }

    /**
     * @Then I will see lots and lots of comics and images
     */
    public function iWillSeeLotsAndLotsOfComicsAndImages()
    {
        $this->assertPageContainsText("BLACK CAT makes her move against SPIDER-MAN!!!");
    }
}
